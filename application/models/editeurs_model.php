<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Editeurs_model extends CI_Model {

    protected $table = 'editeur';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_editeurs($_nom, $_lien)
    {
        $this->db->set('nom',  $_nom);
        $this->db->set('lien_contact',  $_lien);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }

    public function exists_editeurs($_condition)
    {
        $editeur = $this->db->select('id')->from($this->table)->where($_condition)->get()->result();
        return !empty($editeur) ? $editeur[0]->id : false;
    }

}