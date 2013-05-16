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
    const LIMIT_ROWS_TO_FETCH = 10;

    const TABLE_APPAWARE = 'spool_crawl_application_appaware';
    const TABLE_ANDROID = 'spool_crawl_application_android';
    const TABLE_APPLE = 'spool_crawl_application_apple';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_packages($_package, $_device, $_table)
    {
        return $this->db->where(array('package' => $_package, 'device_id' => $_device))->count_all_results($_table) > 0;
    }

    public function insert_package($_package, $_device, $_table)
    {
        $this->db->set('package',  $_package);
        $this->db->set('device_id',  $_device);
        $this->db->set('status',  self::STATUS_TO_ADD);
        return $this->db->insert($_table);
    }

    public function get_unadded_packages($_device, $_table)
    {
        return $this->db->where(array('device_id' => $_device, 'status' => self::STATUS_TO_ADD))->limit(self::LIMIT_ROWS_TO_FETCH)->get($_table)->result();
    }

    public function set_package_added($_package, $_device, $_table)
    {
        return $this->db->set(array('status' => self::STATUS_ADDED))
                        ->where(array('package' => $_package, 'device_id' => $_device))
                        ->update($_table);
    }

}