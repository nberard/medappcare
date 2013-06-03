<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Pages_model extends CI_Model {

    protected $table = 'page';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_page($_nom)
    {
        return $this->db->select('*, contenu_'.config_item('lng').' AS contenu')->get_where($this->table, array('nom' => $_nom))->row();
    }

}