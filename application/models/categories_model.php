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
        return $this->db->where(array('id' => $_id))->get($this->table)->row();
    }

    public function get_categories_parentes($_pro)
    {
        return $this->db->where(array('parent_id' => -1, 'est_pro' => $_pro ? 1 : 0))->get($this->table)->result();
    }

    public function get_categories_enfantes($_parent_id)
    {
        return $this->db->where(array('parent_id' => $_parent_id))->order_by('nom_'.config_item('language_short').', poids', 'asc')->get($this->table)->result();
    }
}