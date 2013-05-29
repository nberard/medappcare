<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Accessoires_model extends CI_Model {

    protected $table = 'accessoire';
    protected $tableFabriquant = 'accessoire_fabriquant';
    protected $tablePhoto = 'accessoire_photo';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_accessoires($_limit)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom, presse_'.config_item('lng').' AS presse')->limit($_limit)->order_by('id', 'desc')->get($this->table)->result();
    }

    public function get_accessoire($_id)
    {
        return $this->db->select('A.*, A.nom_'.config_item('lng').' AS nom, A.presse_'.config_item('lng').' AS presse, '.
                                 'F.nom AS nom_fabriquant, A.avis_'.config_item('lng').' AS avis, '.
                                 'A.mot_fabriquant_'.config_item('lng').' AS mot_fabriquant')
                        ->from($this->table.' A')
                        ->join($this->tableFabriquant.' F', 'F.id = A.fabriquant_id', 'INNER')
                        ->where(array('A.id' => $_id))->get()->row();
    }

    public function get_photo_from_accessoire($_id)
    {
        $res = $this->db->get_where($this->tablePhoto, array('accessoire_id' => $_id))->result();
        if(!empty($res))
        {
            $upload_paths = config_item('upload_paths');
            foreach ($res as &$photo)
            {
                $photo->full_url = base_url().$upload_paths['accessoire'].'/'.$photo->photo;
            }
        }
        return $res ? $res : array();
    }

    public function get_accessoires_from_application($_application_id)
    {
        $this->db->select('A.*, A.nom_'.config_item('lng').' AS nom, A.presse_'.config_item('lng').' AS presse')
                ->join('accessoire_application_compatible AAC', 'AAC.accessoire_id=A.id', 'LEFT');
        $res = $this->db->get_where($this->table.' A', array('AAC.application_id' => $_application_id))->result();
        return $res ? $res : array();

    }

}