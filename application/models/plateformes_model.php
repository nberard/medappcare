<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Plateformes_model extends CI_Model {

    protected $table = 'plateforme';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_all_plateformes()
    {
        return $this->db->get($this->table)->result();
    }

}