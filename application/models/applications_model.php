<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Applications_model extends CI_Model {

    protected $table = 'application';
    protected $tableNotes = 'application_note';
    protected $tableSelection = 'selection_items';
    protected $tableEditeur = 'editeur';
    protected $tableMembre = 'membre';
    protected $tableDevice = 'device';
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
        $this->db->set('est_valide', 0);

        $this->db->set('date_ajout', 'NOW()', false);
        return $this->db->insert($this->table);
    }

    public function exists_applications($_conditionString, $_condition_Int = array())
    {
        return $this->db->where($_conditionString)->where($_condition_Int, NULL, FALSE)->count_all_results($this->table) > 0;
    }

    public function get_last_eval_applications($_category_id = -1, $_limit = 5)
    {
        $this->db->select('CEIL(AVG(N.note)) AS moyenne_note, A.*, C.nom_'.config_item('lng').' AS nom_categorie, D.nom AS device_nom, D.class as device_class')
                ->from($this->table.' A')
                ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
                ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
                ->join($this->tableNotes.' N', 'A.id = N.application_id', 'LEFT')
                ->group_by('A.id')
                ->limit($_limit)->order_by('id', 'desc');
        if($_category_id != -1)
        {
            $this->db->where(array('categorie_id' => $_category_id));
        }
        $this->db->where(array('est_valide' => 1));
        $res = $this->db->get()->result();
        return $res ? $res : array();
    }

    public function get_top_five_applications($_free, $_pro, $_category_id = -1, $_limit = 5)
    {
        $this->db->select('CEIL(AVG(N.note)) AS moyenne_note, A.*, C.nom_'.config_item('lng').' AS nom_categorie, D.nom AS device_nom, D.class as device_class')
            ->from($this->table.' A')
            ->join($this->tableCategorie.' C', 'A.categorie_id = C.id', 'LEFT')
            ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
            ->join($this->tableNotes.' N', 'A.id = N.application_id', 'LEFT')
            ->group_by('A.id')
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
        $this->db->where(array('est_valide' => 1, 'A.est_pro' => $_pro ? 1 : 0));
        $res = $this->db->get()->result();
        return $res ? $res : array();
    }

    public function get_selection_applications($_id_selection)
    {
        return $this->db->from($this->table)
                    ->join($this->tableSelection, $this->table.'.id = '.$this->tableSelection.'.application_id')
                    ->where(array('selection_id' => $_id_selection))->get()->result();
    }

    public function get_application($_id)
    {
        return $this->db->select('CEIL(AVG(N1.note)) as moyenne_note_user, CEIL(AVG(N2.note)) as moyenne_note_pro, A.*, E.nom AS nom_editeur, E.lien_contact, C.class, D.nom AS device_nom, D.class AS device_class')
            ->from($this->table.' A')
            ->join($this->tableNotes.' N1', 'A.id = N1.application_id', 'LEFT')
            ->join($this->tableMembre.' M1', 'M1.id = N1.membre_id AND M1.est_pro = 0', 'INNER')
            ->join($this->tableNotes.' N2', 'A.id = N2.application_id', 'LEFT')
            ->join($this->tableMembre.' M2', 'M2.id = N2.membre_id AND M2.est_pro = 1', 'INNER')
            ->join($this->tableEditeur.' E', 'E.id = A.editeur_id', 'INNER')
            ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
            ->join($this->tableCategorie.' C', 'C.id = A.categorie_parente_id', 'LEFT')
            ->where(array('A.id' => $_id))->get()->row();
    }

}