<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Application_screenshots_model extends CI_Model {

    protected $table = 'application_screenshot';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function exists_application_screenshots($_screen, $_application_id)
    {
        return $this->db->where(array('url' => $_screen, 'application_id' => $_application_id))->count_all_results($this->table) > 0;
    }

    public function insert_application_screenshots($_screen, $_application_id)
    {
        $this->db->set('url',  $_screen);
        $this->db->set('application_id',  $_application_id);
        $this->db->insert($this->table);
        return $this->db->insert_id();
    }
}