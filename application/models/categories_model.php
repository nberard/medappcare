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

    public function get_categories_parentes($pro)
    {
        return $this->db->where(array('parent_id' => -1, 'est_pro' => $pro ? 1 : 0))->get($this->table)->result();
    }
}