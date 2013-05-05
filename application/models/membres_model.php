<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Membres_model extends CI_Model {

    protected $table = 'membre';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_membres($_condition)
    {
        $membre = $this->db->select('*')->from($this->table)->where($_condition)->get()->result();
        return !empty($membre) ? $membre[0] : false;
    }

}