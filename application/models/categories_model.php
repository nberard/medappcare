<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Categories_model extends CI_Model {

    const CATEGORY_ALL_GP = 16;
    protected $table = 'categorie';
    protected $tableMembre = 'membre_categorie';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_categories_gp_ids()
    {
        $res = $this->db->select('id')->get_where($this->table, array('est_pro' => 0))->result();
        $gp_ids = array();
        foreach($res as $row)
            $gp_ids[] = $row->id;
        return $gp_ids;
    }

    public function get_categorie($_id)
    {
        return $this->db->select('C.*, C.nom_'.config_item('lng').' AS nom, C2.class')
                        ->join($this->table.' C2', 'C.parent_id = C2.id', 'LEFT')
                        ->where(array('C.id' => $_id))->get($this->table.' C')->row();
    }

    public function get_categories_parentes($_pro)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom')->where(array('parent_id' => -1, 'est_pro' => $_pro ? 1 : 0))->get($this->table)->result();
    }

    public function get_categories_enfantes($_parent_id)
    {
        $this->db->select('*, nom_'.config_item('lng').' AS nom');
        if(is_array($_parent_id))
        {
            $this->db->where('parent_id IN ('.implode(',', $_parent_id).')');
        }
        else
        {
            $this->db->where(array('parent_id' => $_parent_id));
        }
        $this->db->order_by('nom_'.config_item('lng').', poids', 'asc');
        $results = $this->db->get($this->table)->result();
        return $results ? $results : array();
    }

    public function get_categories_from_application($_application_id)
    {
        $this->db->select('C.*, C.nom_'.config_item('lng').' AS nom');
        $this->db->join($this->table.' C','C.id=AC.categorie_id', 'LEFT');
        $results = $this->db->get_where('application_categorie AC', array('AC.application_id' => $_application_id))->result();
        return $results ? $results : array();
    }

    public function get_categories_id_from_membre($_membre_id)
    {
        $results = $this->db->select('C.id')
            ->join($this->tableMembre.' MC','C.id=MC.categorie_id', 'INNER')
            ->join('membre M','M.id=MC.membre_id', 'INNER')
            ->get_where($this->table. ' C', array('M.id' => $_membre_id))->result();
        $results = $results ? $results : array();
        $return = array();
        foreach($results as $result)
        {
            $return[] = $result->id;
        }
        return $return;
    }
}