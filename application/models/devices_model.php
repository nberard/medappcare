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
    protected $tableMembrePlateforme = 'membre_plateforme';
    protected $tablePlateforme = 'plateforme';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_all_devices()
    {
        return $this->db->select('*')->get_where($this->table)->result();
    }

    public function get_devices_from_membre($_membre_id)
    {
        $results = $this->db->select('DISTINCT(P.device_id)')
            ->join($this->tableMembrePlateforme.' MP','P.id=MP.plateforme_id', 'INNER')
            ->join('membre M','M.id = MP.membre_id', 'INNER')
            ->get_where($this->tablePlateforme.' P', array('M.id' => $_membre_id))->result();
        $results = $results ? $results : array();
        $return = array();
        foreach($results as $result)
        {
            $return[] = $result->device_id;
        }
        return $return;
    }

}