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
    protected $tableNotes = 'accessoire_critere_note';
    protected $tableNotation = 'accessoire_notation';
    protected $tablePhoto = 'accessoire_photo';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function get_last_accessoires($_limit)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom, avis_'.config_item('lng').' AS avis')->limit($_limit)->order_by('id', 'desc')->get($this->table)->result();
    }

    public function get_accessoire($_id)
    {
        return $this->db->select('ROUND(AVG(NC.note)) as moyenne_note, A.*, A.nom_'.config_item('lng').' AS nom, A.presse_'.config_item('lng').' AS presse, '.
                                 'F.nom AS nom_fabriquant, A.avis_'.config_item('lng').' AS avis, '.
                                 'A.mot_fabriquant_'.config_item('lng').' AS mot_fabriquant')
                        ->from($this->table.' A')
                        ->join($this->tableNotation.' N', 'N.accessoire_id = A.id', 'LEFT')
                        ->join($this->tableNotes.' NC', 'NC.accessoire_notation_id = N.id', 'INNER')
                        ->join($this->tableFabriquant.' F', 'F.id = A.fabriquant_id', 'LEFT')
                        ->group_by('A.id')
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

    public function get_notes_from_accessoire($_id, $_limit = 4, $_offset = 0)
    {
        $res = $this->db->select('C.nom_'.config_item('lng').' AS critere, N.commentaire_'.config_item('lng').' as commentaire, M.pseudo, N.date, NC.note, NC.critere_id')
            ->from($this->table.' A')
            ->join($this->tableNotation.' N', 'N.accessoire_id = A.id', 'LEFT')
            ->join($this->tableNotes.' NC', 'NC.accessoire_notation_id = N.id', 'INNER')
            ->join('critere_accessoire C', 'NC.critere_id = C.id', 'INNER')
            ->join('membre M', 'M.id = N.membre_id', 'INNER')
            ->group_by('M.id, NC.critere_id')
            ->limit($_limit, $_offset)
            ->where(array('A.id' => $_id))
            ->get()->result();

        return $res ? $res : array();
    }

    public function get_moyennes_from_accessoire($_id)
    {
        $res = $this->db->select('ROUND(AVG(note)) AS note, C.nom_'.config_item('lng').' AS critere')
            ->from($this->table.' A')
            ->join($this->tableNotation.' N', 'N.accessoire_id = A.id', 'LEFT')
            ->join($this->tableNotes.' NC', 'NC.accessoire_notation_id = N.id', 'INNER')
            ->join('critere_accessoire C', 'NC.critere_id = C.id', 'INNER')
            ->group_by('NC.critere_id')
            ->where(array('A.id' => $_id))
            ->get()->result();

        return $res ? $res : array();
    }

    public function get_accessoires_from_application($_application_id)
    {
        $this->db->select('A.*, A.nom_'.config_item('lng').' AS nom, A.avis_'.config_item('lng').' AS avis')
                ->join('accessoire_application_compatible AAC', 'AAC.accessoire_id=A.id', 'LEFT');
        $res = $this->db->get_where($this->table.' A', array('AAC.application_id' => $_application_id))->result();
        return $res ? $res : array();

    }

    public function add_notes_to_accessoire($_accessoire_id, $_membre_id, $_notes, $_commentaire)
    {
        $this->db->set('accessoire_id', $_accessoire_id);
        $this->db->set('membre_id', $_membre_id);
        $this->db->set('commentaire_'.config_item('lng'), $_commentaire);
        $this->db->set('est_suspendu', 0);
        $this->db->set('date', 'NOW()', false);
        $notation_inserted = $this->db->insert($this->tableNotation);
        if($notation_inserted)
        {
            $notation_id = $this->db->insert_id();
            foreach($_notes as $critere_id => $note)
            {
                $this->db->set('accessoire_notation_id', $notation_id);
                $this->db->set('critere_id', $critere_id);
                $this->db->set('note', $note);
                if(!$this->db->insert($this->tableNotes))
                {
                    return false;
                }
            }
            return true;
        }
        else
        {
            return false;
        }
    }

    public function user_has_note_accessoire($_accessoire_id, $_membre_id)
    {
        return $this->db->where(array('membre_id' => $_membre_id, 'accessoire_id' => $_accessoire_id))->count_all_results($this->tableNotation) > 0;
    }

    public function get_criteres_for_accessoires()
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom')->get('critere_accessoire')->result();
    }
}