<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Accessoires_model extends CI_Model {

    protected $table = 'accessoire';
    protected $tableFabriquant = 'accessoire_fabriquant';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_accessoires($_limit)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom, presse_'.config_item('lng').' AS presse')->limit($_limit)->order_by('id', 'desc')->get($this->table)->result();
    }

    public function get_accessoire($_id)
    {
        return $this->db->select('A.*, A.nom_'.config_item('lng').' AS nom, A.presse_'.config_item('lng').' AS presse, F.nom AS nom_fabriquant')->from($this->table.' A')
                        ->join($this->tableFabriquant.' F', 'F.id = A.fabriquant_id', 'INNER')
                        ->where(array('A.id' => $_id))->get()->row();
    }

}