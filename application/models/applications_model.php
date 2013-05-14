<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Applications_model extends CI_Model {

    protected $table = 'application';
    protected $tableSelection = 'selection_items';
    protected $tableEditeur = 'editeur';
    protected $tableCategorie = 'categorie';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_applications($_nom, $_package, $_device, $_titre, $_description, $_prix, $_devise,
                                        $_langue_store, $_langue_appli, $_editeur_id, $_categorie_id, $_lien_download,
                                        $_logo_url, $_version)
    {
//        log_message('info',"insert_applications($_nom, $_package, $_device, $_titre, $_description, $_prix, $_devise, $_langue_store, $_langue_appli, $_editeur_id, $_categorie_id, $_lien_download, $_logo_url, $_version)");
        $this->db->set('nom',  $_nom);
        $this->db->set('package',  $_package);
        $this->db->set('device_id',  $_device);
        $this->db->set('titre',   $_titre);
        $this->db->set('description', $_description);
        $this->db->set('prix', $_prix);
        $this->db->set('devise', $_devise);
        $this->db->set('langue_store', $_langue_store);
        $this->db->set('langue_appli', $_langue_appli);
        $this->db->set('editeur_id', $_editeur_id);
        $this->db->set('categorie_id', $_categorie_id);
        $this->db->set('lien_download', $_lien_download);
        $this->db->set('version', $_version);
        $this->db->set('logo_url', $_logo_url);
        $this->db->set('mots_cles', '');
        $this->db->set('est_liste', 1);
        $this->db->set('est_partageable', 1);
        $this->db->set('est_pro', 0);
        $this->db->set('est_penalisee', 0);

        $this->db->set('date_ajout', 'NOW()', false);
        return $this->db->insert($this->table);
    }

    public function exists_applications($_conditionString, $_condition_Int = array())
    {
        return $this->db->where($_conditionString)->where($_condition_Int, NULL, FALSE)->count_all_results($this->table) > 0;
    }

    public function get_last_eval_applications($_category_id = -1, $_limit = 5)
    {
        $this->db->select('A.*, C.nom_'.config_item('lng').' AS nom_categorie')
                ->from($this->table.' A')
                ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
                ->limit($_limit)->order_by('id', 'desc');
        if($_category_id != -1)
        {
            $this->db->where(array('categorie_id' => $_category_id));
        }
        $res = $this->db->get()->result();
        return $res ? $res : array();
    }

    public function get_top_five_applications($_free, $_category_id = -1, $_limit = 5)
    {
        $this->db->select('A.*, C.nom_'.config_item('lng').' AS nom_categorie')
            ->from($this->table.' A')
            ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
            ->limit($_limit)->order_by('id', 'asc');
        if($_category_id != -1)
        {
            $this->db->where(array('categorie_id' => $_category_id));
        }
        if($_free)
        {
            $this->db->where(array('prix' => 0.00));
        }
        else
        {
            $this->db->where('prix > 0.00');
        }
        $res = $this->db->get()->result();
        return $res ? $res : array();
    }

    public function get_selection_applications($_idSelection)
    {
        return $this->db->from($this->table)
                    ->join($this->tableSelection, $this->table.'.id = '.$this->tableSelection.'.application_id')
                    ->where(array('selection_id' => $_idSelection))->get()->result();
    }

    public function get_application($_id)
    {
        return $this->db->select(
                $this->table.'.*, '
                .$this->tableEditeur.'.nom as nom_editeur, '
                .$this->tableEditeur.'.lien_contact, '
                .$this->tableCategorie.'.class'
            )->from($this->table)
            ->join($this->tableEditeur, $this->tableEditeur.'.id = '.$this->table.'.editeur_id', 'INNER')
            ->join($this->tableCategorie, $this->tableCategorie.'.id = '.$this->table.'.categorie_parente_id', 'LEFT')
            ->where(array($this->table.'.id' => $_id))->get()->row();
    }

}