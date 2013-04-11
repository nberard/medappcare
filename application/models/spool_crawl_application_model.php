<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Spool_crawl_applications_model extends CI_Model {

    const STATUS_TO_ADD = 0;
    const STATUS_ADDED = 1;

    protected $table = 'spool_crawl_application';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_packages($_package, $_device)
    {
        return $this->db->where(array('package' => $_package, 'device_id' => $_device))->count_all_results($this->table) > 0;
    }

    public function insert_package($_package, $_device)
    {
        $this->db->set('package',  $_package);
        $this->db->set('device',  $_device);
        $this->db->set('status',  self::STATUS_TO_ADD);
        return $this->db->insert($this->table);
    }

    public function get_unadded_packages($_device)
    {
        $this->db->select('package')->from($this->table)->where(array('device' => $_device, 'status' => self::STATUS_TO_ADD));
    }

    public function set_package_added($_package, $_device)
    {
        return $this->db->set(array('status' => self::STATUS_ADDED))
                        ->where(array('package' => $_package, 'device' => $_device))
                        ->update($this->table);
    }

}