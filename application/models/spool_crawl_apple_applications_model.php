<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Spool_crawl_apple_applications_model extends CI_Model {

    const STATUS_TO_ADD = 0;
    const STATUS_ADDED = 1;
    const LIMIT_ROWS_TO_FETCH = 500;

    protected $table = 'spool_crawl_application_apple';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_packages($_package)
    {
        return $this->db->where(array('package' => $_package))->count_all_results($this->table) > 0;
    }

    public function insert_package($_package, $_application_id)
    {
        $this->db->set('package',  $_package);
        $this->db->set('application_id',  $_application_id);
        $this->db->set('status',  self::STATUS_TO_ADD);
        return $this->db->insert($this->table);
    }

    public function get_unadded_packages()
    {
        return $this->db->where(array('status' => self::STATUS_TO_ADD))->limit(self::LIMIT_ROWS_TO_FETCH)->get($this->table)->result();
    }

    public function set_package_added($_package)
    {
        return $this->db->set(array('status' => self::STATUS_ADDED))
            ->where(array('package' => $_package))
            ->update($this->table);
    }

}