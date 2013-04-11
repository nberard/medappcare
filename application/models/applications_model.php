<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Applications_model extends CI_Model {

    protected $table = 'application';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_applications($_nom, $_package, $_device, $_titre, $_description, $_prix, $_devise,
                                        $_langue_store, $_langue_appli, $_editeur_id, $_categorie_id, $_lien_download,
                                        $_version)
    {
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
        $this->db->set('mots_cles', '');
        $this->db->set('est_liste', 1);
        $this->db->set('est_partageable', 1);
        $this->db->set('est_pro', 0);
        $this->db->set('est_penalisee', 0);

        $this->db->set('date_ajout', 'NOW()', false);
        return $this->db->insert($this->table);
    }

    public function exists_applications($_condition)
    {
        return $this->db->where($_condition)->count_all_results($this->table) > 0;
    }

}