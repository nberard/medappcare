<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Devices_model extends CI_Model {

    const APPLICATION_DEVICE_APPLE = 1;
    const APPLICATION_DEVICE_ANDROID = 2;

    protected $table = 'device';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_all_devices()
    {
        return $this->db->select('*')->get_where($this->table)->result();
    }

}