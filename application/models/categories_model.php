<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Categories_model extends CI_Model {

    protected $table = 'categorie';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_categorie($_id)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom')->where(array('id' => $_id))->get($this->table)->row();
    }

    public function get_categories_parentes($_pro)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom')->where(array('parent_id' => -1, 'est_pro' => $_pro ? 1 : 0))->get($this->table)->result();
    }

    public function get_categories_enfantes($_parent_id)
    {
        $this->db->select('*, nom_'.config_item('lng').' AS nom');
        if(is_array($_parent_id))
        {
            $this->db->where('parent_id IN ('.implode(',', $_parent_id).')');
        }
        else
        {
            $this->db->where(array('parent_id' => $_parent_id));
        }
        $this->db->order_by('nom_'.config_item('lng').', poids', 'asc');
        $results = $this->db->get($this->table)->result();
        return $results ? $results : array();
    }
}