<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Selections_model extends CI_Model {

    protected $table = 'selection';

    const TYPE_SELECTION_APPLICATIONS = 0;
    const TYPE_SELECTION_ACCESSOIRES = 1;
    const LIMIT_LIST_SELECTION = 4;

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_selection($_id)
    {
        return $this->db->get_where($this->table, array('id' => $_id))->row();
    }

    public function get_selections($_access, $_category_id)
    {
        if($_category_id != -1)
        {
            $this->db->where(array('categorie_id' => $_category_id));
        }
        if(!empty($_access))
        {
            $this->db->where(array('home_'.$_access => 1));
        }
        $this->db->where('date_debut < NOW()');
        $this->db->where('date_fin > NOW()');
        $this->db->order_by('poids', 'asc');
        $res = $this->db->get($this->table, self::LIMIT_LIST_SELECTION)->result();
        return $res ? $res : array();
    }

    public function get_selections_from_home($_access)
    {
        return $this->get_selections($_access, -1);
    }

    public  function get_selections_from_category($_category_id)
    {
        return $this->get_selections('', $_category_id);
    }

}