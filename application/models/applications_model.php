<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 08/04/13
 * Time: 14:42
 */
class Applications_model extends CI_Model {

    protected $table = 'application';
//    protected $tableNotes = 'application_note';
    protected $tableEditeur = 'editeur';
    protected $tableMembre = 'membre';
    protected $tableDevice = 'device';
    protected $tableCategorie = 'categorie';

    protected $tableNotesPro = 'application_critere_note_pro';
    protected $tableNotationPro = 'application_notation_pro';
    protected $tableCriteresPro = 'critere_application_pro';

    protected $tableNotesPerso = 'application_critere_note_perso';
    protected $tableNotationPerso = 'application_notation_perso';
    protected $tableCriteresPerso = 'critere_application_perso';

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }

    public function insert_applications($_nom, $_package, $_device, $_titre, $_description, $_prix, $_devise,
                                        $_langue_store, $_langue_appli, $_editeur_id, $_categorie_id, $_lien_download,
                                        $_logo_url, $_version)
    {
//        log_message('info',"insert_applications($_nom, $_package, $_device, $_titre, $_description, $_prix, $_devise, $_langue_store, $_langue_appli, $_editeur_id, $_categorie_id, $_lien_download, $_logo_url, $_version)");
        $this->db->set('nom',  $_nom);
        $this->db->set('package',  $_package);
        $this->db->set('device_id',  $_device);
        $this->db->set('titre',   $_titre);
        $this->db->set('description', $_description);
        $this->db->set('prix', $_prix);
        $this->db->set('devise', $_devise);
        $this->db->set('langue_store', $_langue_store);
        $this->db->set('langue_appli', $_langue_appli);
        $this->db->set('editeur_id', $_editeur_id);
        $this->db->set('categorie_id', $_categorie_id);
        $this->db->set('lien_download', $_lien_download);
        $this->db->set('version', $_version);
        $this->db->set('logo_url', $_logo_url);
        $this->db->set('mots_cles', '');
        $this->db->set('est_liste', 1);
        $this->db->set('est_partageable', 1);
        $this->db->set('est_pro', 0);
        $this->db->set('est_penalisee', 0);
        $this->db->set('est_valide', 0);

        $this->db->set('date_ajout', 'NOW()', false);
        return $this->db->insert($this->table);
    }

    public function update_application($_updates, $_conditions)
    {
        if(!empty($_updates) && !empty($_conditions))
        {
            return $this->db->update($this->table, $_updates, $_conditions);
        }
        else
        {
            return false;
        }
    }

    public function exists_applications($_conditionString, $_condition_Int = array())
    {
        return $this->db->where($_conditionString)->where($_condition_Int, NULL, FALSE)->count_all_results($this->table) > 0;
    }

    public function get_last_eval_applications($_pro, $_category_id = -1, $_limit = 5)
    {
        return $this->get_applications($_pro, -1, $_category_id, null, true, -1, -1, -1, 'id', 'desc', 5);
    }

    public function get_applications($_pro, $_devices_id, $_categorie_id, $_term, $_eval_medappcare, $_free, $_selection_id,
                                     $_accessoire_ref_id, $_sort = 'id', $_order = 'desc', $_limit = 0, $_offset = 0)
    {
        $callers=debug_backtrace();
        log_message('debug', "get_applications($_pro, $_devices_id, $_categorie_id, $_term, $_eval_medappcare, $_free, $_selection_id,
                                     $_accessoire_ref_id, $_sort = 'id', $_order = 'desc', $_limit = 0, $_offset = 0)".' caller = '.var_export($callers[1]['function'], true));
        $this->db->select('A.*, D.nom AS device_nom, D.class as device_class')
            ->from($this->table.' A')
            ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
//            ->join($this->tableNotes.' N', 'A.id = N.application_id', 'LEFT')
            ->group_by('A.id')
            ->order_by($_sort, $_order);
        if($_limit > 0)
        {
            $this->db->limit($_limit, $_offset);
        }
        if($_categorie_id != -1)
        {
            $this->db->join('application_categorie C', 'A.id = C.application_id', 'INNER');
            $this->db->where(array('C.categorie_id' => $_categorie_id));
        }
        if($_free !== -1)
        {
            if($_free === true)
            {
                $this->db->where(array('prix' => 0.00));
            }
            else
            {
                $this->db->where('prix > 0.00');
            }
        }
        if(!is_null($_term))
        {
            $this->db->where("(LOWER(A.nom) LIKE '%".strtolower($_term)."%') OR (LOWER(A.titre) LIKE '%".strtolower($_term)."%')");
        }
        if($_devices_id !== -1)
        {
            if(is_array($_devices_id))
            {
                $this->db->where('device_id IN ('.implode(',', $_devices_id).')');
            }
            else
            {
                $this->db->where(array('device_id' => $_devices_id));
            }
        }
        if($_eval_medappcare)
        {
            $this->db->select('CEIL(A.note_medappcare) AS moyenne_note_medappcare');
            $this->db->where('A.note_medappcare > 0.00');
        }
        if($_accessoire_ref_id != -1)
        {
            $this->db->join('accessoire_application_compatible AAC', 'AAC.application_id = A.id', 'INNER');
            $this->db->where(array('AAC.accessoire_id' => $_accessoire_ref_id));
        }
        if($_selection_id != -1)
        {
            $this->db->join('selection_application S', 'S.application_id = A.id', 'INNER');
        }
        if(!is_null($_pro))
        {

            $this->db->where(array('A.est_pro' => $_pro ? 1 : 0));
        }
        $this->db->where(array('est_valide' => 1));
        $res = $this->db->get()->result();
        return $res ? $res : array();
    }

    public function update_note_medappcare($_application_id)
    {

    }

    public function get_applications_from_categorie($_pro, $_devices_id, $_categorie_id, $_free, $_sort, $_order, $_page)
    {
        log_message('debug', "get_applications_from_categorie($_pro, ".var_export($_devices_id,true).", $_categorie_id, $_free, $_sort, $_order, $_page)");
        return $this->get_applications($_pro, $_devices_id, $_categorie_id, null, false, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), $_page);
    }

    public function get_applications_classic($_pro, $_devices_id, $_term, $_eval_medapp, $_free, $_sort, $_order, $_page)
    {
        return $this->get_applications($_pro, $_devices_id, -1, $_term, $_eval_medapp, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), $_page);
    }

    public function get_top_five_applications($_free, $_pro, $_category_id = -1)
    {
        return $this->get_applications($_pro, -1, $_category_id, null, false, $_free, -1, -1, 'id', 'desc', 5);
    }

    public function get_applications_compatibles($_pro, $_accessoire_id)
    {
        return $this->get_applications($_pro, -1, -1, null, false, -1, -1, $_accessoire_id, 'id', 'desc', 10);
    }

    public function get_applications_from_selection($_selection_id)
    {
        return $this->get_applications(null, -1, -1, null, false, -1, $_selection_id, -1);
    }

    public function get_application($_id)
    {
        return $this->db->select('A.*, E.nom AS nom_editeur, E.lien_contact, A.class, D.nom AS device_nom, D.class AS device_class')
            ->from($this->table.' A')
//            ->join($this->tableNotes.' N1', 'A.id = N1.application_id', 'LEFT')
//            ->join($this->tableMembre.' M1', 'M1.id = N1.membre_id AND M1.est_pro = 0', 'INNER')
//            ->join($this->tableNotes.' N2', 'A.id = N2.application_id', 'LEFT')
//            ->join($this->tableMembre.' M2', 'M2.id = N2.membre_id AND M2.est_pro = 1', 'INNER')
            ->join($this->tableEditeur.' E', 'E.id = A.editeur_id', 'INNER')
            ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
//            ->join($this->tableCategorie.' C', 'C.id = A.categorie_parente_id', 'LEFT')
            ->where(array('A.id' => $_id))->get()->row();
    }

    public function get_criteres_for_applications($_pro)
    {
        return $this->db->select('*, nom_'.config_item('lng').' AS nom')->get($this->getTableName('criteres', $_pro))->result();
    }

    public function user_has_note_application($_pro, $_application_id, $_membre_id)
    {
        return $this->db->where(array('membre_id' => $_membre_id, 'application_id' => $_application_id))->count_all_results($this->getTableName('notation', $_pro)) > 0;
    }

    private function getTableName($_table, $_pro)
    {
        if($_table == 'notes')
        {
            return $_pro ? $this->tableNotesPro : $this->tableNotesPerso;
        }
        else if($_table == 'notation')
        {
            return $_pro ? $this->tableNotationPro : $this->tableNotationPerso;
        }
        else if($_table == 'criteres')
        {
            return $_pro ? $this->tableCriteresPro : $this->tableCriteresPerso;
        }
    }

    public function get_notes_from_application($_pro, $_id, $_limit = 4, $_offset = 0)
    {
        $res = $this->db->select('C.nom_'.config_item('lng').' AS critere, N.commentaire_'.config_item('lng').' as commentaire, M.pseudo, N.date, NC.note, NC.critere_id')
            ->from($this->table.' A')
            ->join($this->getTableName('notation', $_pro).' N', 'N.application_id = A.id', 'LEFT')
            ->join($this->getTableName('notes', $_pro).' NC', 'NC.application_notation_id = N.id', 'INNER')
            ->join($this->getTableName('criteres', $_pro).' C', 'NC.critere_id = C.id', 'INNER')
            ->join('membre M', 'M.id = N.membre_id', 'INNER')
            ->group_by('M.id, NC.critere_id')
            ->limit($_limit, $_offset)
            ->where(array('A.id' => $_id))
            ->get()->result();

        return $res ? $res : array();
    }

    public function get_moyennes_from_application($_pro, $_id)
    {
        $res = $this->db->select('ROUND(AVG(note)) AS note, C.nom_'.config_item('lng').' AS critere')
            ->from($this->table.' A')
            ->join($this->getTableName('notation', $_pro).' N', 'N.application_id = A.id', 'LEFT')
            ->join($this->getTableName('notes', $_pro).' NC', 'NC.application_notation_id = N.id', 'INNER')
            ->join($this->getTableName('criteres', $_pro).' C', 'NC.critere_id = C.id', 'INNER')
            ->group_by('NC.critere_id')
            ->where(array('A.id' => $_id))
            ->get()->result();

        return $res ? $res : array();
    }

    public function add_notes_to_application($_pro, $_application_id, $_membre_id, $_notes, $_commentaire)
    {
        log_message("add_notes_to_application($_pro, $_application_id, $_membre_id, =".var_export($_notes, true).", $_commentaire from".__FUNCTION__."at line ".__LINE__, "nico");
        $this->db->set('application_id', $_application_id);
        $this->db->set('membre_id', $_membre_id);
        $this->db->set('commentaire_'.config_item('lng'), $_commentaire);
        $this->db->set('est_suspendu', 0);
        $this->db->set('date', 'NOW()', false);
        $notation_inserted = $this->db->insert($this->getTableName('notation', $_pro));
        if($notation_inserted)
        {
            $notation_id = $this->db->insert_id();
            foreach($_notes as $critere_id => $note)
            {
                $this->db->set('application_notation_id', $notation_id);
                $this->db->set('critere_id', $critere_id);
                $this->db->set('note', $note);
                if(!$this->db->insert($this->getTableName('notes', $_pro)))
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

}