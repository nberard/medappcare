<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Accessoires_model extends CI_Model {

    protected $table = 'accessoire';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_accessoires($_limit)
    {
        return $this->db->limit($_limit)->order_by('id', 'desc')->get($this->table)->result();
    }

}