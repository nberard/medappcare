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
//        $this->db->set('categorie_id', $_categorie_id);
        $this->db->set('lien_download', $_lien_download);
        $this->db->set('version', $_version);
        $this->db->set('logo_url', $_logo_url);
        $this->db->set('mots_cles', '');
        $this->db->set('est_liste', 0);
        $this->db->set('est_dispo_medical', 0);
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

    public function get_last_eval_applications($_pro, $_category_id = -1)
    {
        $user = $this->session->userdata('user');
        $devices = isset($user->devices) ? $user->devices : -1;
        if($_category_id == -1 && !empty($user->categories))
        {
            $applications_categories = $this->get_applications($_pro, $devices, $user->categories, null, true, -1, -1, -1, 'date', 'desc', 5);
            if(count($applications_categories) == 5)
            {
                return $applications_categories;
            }
            $exclude_list = array();
            if(count($applications_categories))
            {
                foreach($applications_categories as $app)
                    $exclude_list[] = $app->id;
            }
            $applications_complement = $this->get_applications($_pro, $devices, $_category_id, null, true, -1, -1, -1, 'date', 'desc', 5 - count($applications_categories), 0, $exclude_list);
            return array_merge($applications_categories, $applications_complement);
        }
        else
        {
            return $this->get_applications($_pro, $devices, $_category_id, null, true, -1, -1, -1, 'date', 'desc', 5);
        }
    }

    public function get_applications($_pro, $_devices_id, $_categorie_id, $_term, $_eval_medappcare, $_free, $_selection_id,
                                     $_accessoire_ref_id, $_sort = 'id', $_order = 'desc', $_limit = 0, $_offset = 0, $_exclude_list = array(), $_get_count = false)
    {
        $callers=debug_backtrace();
        log_message('debug', "get_applications($_pro, ".var_export($_devices_id, true).", ".var_export($_categorie_id, true).", $_term, $_eval_medappcare, $_free, $_selection_id,
                                     $_accessoire_ref_id, $_sort = 'id', $_order = 'desc', $_limit = 0, $_offset = 0)".' caller = '.var_export($callers[1]['function'], true));

        if($_sort == 'date')
        {
            $this->db->join('application_notation_medappcare NM', 'NM.application_id = A.id', 'LEFT');
        }
        $sort_corresp = array(
            'date' => 'NM.date',
            'note' => 'moyenne_note_medappcare',
        );
        if(!$_get_count)
        {
            $_sort = isset($sort_corresp[$_sort]) ? $sort_corresp[$_sort] : $_sort;
            $this->db->from($this->table.' A')
                ->select('A.*, D.nom AS device_nom, D.class as device_class,
                            IF( A.note_medappcare > 0.00, ROUND( A.note_medappcare ) , ROUND( AVG( 2 * ANP.note ) ) ) AS moyenne_note_medappcare')
                ->group_by('A.id')
                ->order_by($_sort, $_order);
            if($_limit > 0)
            {
                $this->db->limit($_limit, $_offset);
            }
        }
        $this->db->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
            ->join($this->getTableName('notation', $_pro).' ANO', 'ANO.application_id = A.id', 'LEFT')
            ->join($this->getTableName('notes', $_pro).' ANP', 'ANP.application_notation_id = ANO.id', 'LEFT');

        if($_categorie_id != -1)
        {
            if(is_array($_categorie_id))
            {
                $this->db->join('application_categorie C', 'A.id = C.application_id', 'INNER');
                $this->db->where('C.categorie_id IN ('.implode(',',$_categorie_id).')');
            }
            else
            {
                $this->db->join('application_categorie C', 'A.id = C.application_id', 'INNER');
                $this->db->where(array('C.categorie_id' => $_categorie_id));
            }
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
            $this->db->where("((LOWER(A.nom) LIKE '%".strtolower($_term)."%') OR (LOWER(A.titre) LIKE '%".strtolower($_term)."%'))");
        }
        if($_devices_id != -1)
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
        if(!empty($_exclude_list))
        {
            $this->db->where('A.id NOT IN('.implode(',',$_exclude_list).')');
        }
        $this->db->where(array('est_valide' => 1));
        if($_get_count)
        {
            return $this->db->count_all_results($this->table.' A');
        }
        else
        {
            $res = $this->db->get()->result();
            return $res ? $res : array();
        }
    }

    public function get_note_medappcare($_pro, $_application_id)
    {
        log_message('debug', "get_note_medappcare($_pro, $_application_id)");
        $this->db->select('SUM(NP.note * CP.poids_pourcent) AS somme_notes_pondere, `CP`.`parent_id`, SUM(CP.poids_pourcent) AS poids_pourcent')
            ->from('application_notation_medappcare NM')
            ->join($this->getTableName('notes_medappcare', $_pro).' NP', 'NP.application_notation_id=NM.id', 'INNER')
            ->join($this->getTableName('criteres_medappcare', $_pro).' CP', 'CP.id=NP.critere_id', 'INNER')
//            ->join($this->getTableName('criteres_medappcare', $_pro).' CP2', 'CP2.id=CP.parent_id', 'INNER')
            ->where(array('NM.application_id' => $_application_id))
            ->group_by('CP.parent_id');
        log_message('debug', "sql=".var_export($this->db->get_compiled_select(), true));
        $sql = $this->db->get_compiled_select();

        $sql = 'SELECT AVG( partial.somme_notes_pondere / partial.poids_pourcent ) AS note_medappcare FROM ('.$sql.') partial';
        log_message('debug', "sql final=".var_export($sql, true));
        log_message('debug', "res=".var_export($this->db->query($sql)->row(), true));
        $row = $this->db->query($sql)->row();
        $this->db->reset_select();
        return $row->note_medappcare;
    }

    public function get_criteres_medappcare($_pro)
    {
        $criteres = $this->db->select('*, nom_'.config_item('lng').' AS nom')->get_where($this->getTableName('criteres_medappcare', $_pro))->result();
        $criteres_ordered = array();
        foreach($criteres as $critere_obj)
        {
            $criteres_ordered[$critere_obj->parent_id][] = $critere_obj;
        }
        $criteres_ordered_tree = $criteres_ordered[-1];
        foreach($criteres_ordered_tree as &$critere_ordered_tree)
        {
            $critere_ordered_tree->childs = $criteres_ordered[$critere_ordered_tree->id];
        }
        return $criteres_ordered_tree;
    }

    public function is_application_pro($_application_id)
    {
        return $this->db->select('est_pro')->get_where($this->table, array('id' => $_application_id))->row()->est_pro == 1;
    }

    public function update_note_medappcare($_application_id)
    {
        //calcul note medappcare si existe
        $_pro = $this->is_application_pro($_application_id);
        log_message('debug', "_pro=".var_export($_pro, true));
        $moyenne_medappcare = $this->get_note_medappcare($_pro, $_application_id);
        if(!is_null($moyenne_medappcare))
        {
            log_message('debug', "OUI");
            //calcul des notes users
            if($_pro)
            {
                $moyenne_users_pro = $this->get_moyenne_users(true, $_application_id);
                log_message('debug', "moyenne_pro=".var_export($moyenne_users_pro, true)."");
                $moyenne_users_perso = null;
            }
            else
            {
                $moyenne_users_pro = $this->get_moyenne_users(false, $_application_id, true);
                log_message('debug', "moyenne_pro=".var_export($moyenne_users_pro, true)."");
                $moyenne_users_perso = $this->get_moyenne_users(false, $_application_id, false);
                log_message('debug', "moyenne_perso=".var_export($moyenne_users_perso, true)."");
            }
            log_message('debug', "moyenne_medappcare=".var_export($moyenne_medappcare, true)."");

            $moyenne_medappcare_modulee = $moyenne_medappcare;
            if(!is_null($moyenne_users_perso))
            {
                $ecart = (($moyenne_users_perso - (config_item('note_max_user') / 2)) * 4 * 10) / 100;
                log_message('debug', "ecart=".var_export($ecart, true));
                $moyenne_medappcare_modulee+=$ecart;
                log_message('debug', "moyenne_medappcare_modulee=".var_export($moyenne_medappcare_modulee, true));
            }

            if(!is_null($moyenne_users_pro))
            {
                $ecart = (($moyenne_users_pro - (config_item('note_max_user') / 2)) * 4 * 10) / 100;
                log_message('debug', "ecart=".var_export($ecart, true));
                $moyenne_medappcare_modulee+=$ecart;
                log_message('debug', "moyenne_medappcare_modulee=".var_export($moyenne_medappcare_modulee, true));
            }

            $moyenne_medappcare_modulee = max(
                config_item('note_min_medappcare'),
                min(
                    config_item('note_max_medappcare'),
                    $moyenne_medappcare_modulee
                )
            );

            $this->db->update($this->table, array('note_medappcare' => $moyenne_medappcare_modulee), array('id' => $_application_id));
        }

    }

    public function get_moyenne_users($_pro, $_application_id, $_membre_pro = null, $_for_display = false)
    {
        if($_for_display)
        {
            $this->db->select('ROUND(AVG(2 * NP.note)) AS moyenne');
        }
        else
        {
            $this->db->select('AVG(NP.note) AS moyenne');
        }
        $this->db->from($this->getTableName('notation', $_pro).' N')
            ->join($this->getTableName('notes', $_pro).' NP', 'NP.application_notation_id = N.id', 'INNER')
            ->where(array('N.application_id' => $_application_id));
        if(!is_null($_membre_pro))
        {
            $this->db->join('membre M', 'N.membre_id = M.id', 'INNER')
                ->where(array('M.est_pro' => $_membre_pro == true ? 1 : 0));
        }
        return $this->db->get()->row()->moyenne;
    }

    public function get_number_applications_from_categorie($_pro, $_devices_id, $_categorie_id, $_free, $_sort, $_order, $_page)
    {
        return $this->get_applications($_pro, $_devices_id, $_categorie_id, null, false, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), ($_page -1) * config_item('nb_results_list'), array(), true);
    }

    public function get_applications_from_categorie($_pro, $_devices_id, $_categorie_id, $_free, $_sort, $_order, $_page)
    {
        return $this->get_applications($_pro, $_devices_id, $_categorie_id, null, false, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), ($_page -1) * config_item('nb_results_list'));
    }

    public function get_applications_classic($_pro, $_devices_id, $_term, $_eval_medapp, $_free, $_sort, $_order, $_page)
    {
        return $this->get_applications($_pro, $_devices_id, -1, $_term, $_eval_medapp, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), ($_page -1) * config_item('nb_results_list'));
    }

    public function get_number_applications_classic($_pro, $_devices_id, $_term, $_eval_medapp, $_free, $_sort, $_order, $_page)
    {
        return $this->get_applications($_pro, $_devices_id, -1, $_term, $_eval_medapp, $_free, -1, -1, $_sort, $_order, config_item('nb_results_list'), ($_page -1) * config_item('nb_results_list'), array(), true);
    }

    public function get_top_five_applications($_free, $_pro, $_category_id = -1)
    {
        $user = $this->session->userdata('user');
        $devices = isset($user->devices) ? $user->devices : -1;
        if($_category_id == -1 && !empty($user->categories))
        {
            $applications_categories = $this->get_applications($_pro, $devices, $user->categories, null, true, $_free, -1, -1, 'id', 'desc', 5);
            if(count($applications_categories) == 5)
            {
                return $applications_categories;
            }
            $exclude_list = array();
            if(count($applications_categories))
            {
                foreach($applications_categories as $app)
                    $exclude_list[] = $app->id;
            }
            $applications_complement = $this->get_applications($_pro, $devices, -1, null, true, $_free, -1, -1, 'id', 'desc', 5 - count($applications_categories), 0, $exclude_list);
            return array_merge($applications_categories, $applications_complement);
        }
        else
        {
            return $this->get_applications($_pro, $devices, $_category_id, null, true, $_free, -1, -1, 'id', 'desc', 5);
        }
    }

    public function get_pour_les_pros_applications($_sort, $_category_id = -1)
    {
        $user = $this->session->userdata('user');
        $devices = isset($user->devices) ? $user->devices : -1;
        if($_category_id == -1 && !empty($user->categories))
        {
            $applications_categories = $this->get_applications(true, $devices, $user->categories, null, true, -1, -1, -1, $_sort, 'desc', 5);
            if(count($applications_categories) == 5)
            {
                return $applications_categories;
            }
            $exclude_list = array();
            if(count($applications_categories))
            {
                foreach($applications_categories as $app)
                    $exclude_list[] = $app->id;
            }
            $applications_complement = $this->get_applications(true, $devices, $_category_id, null, true, -1, -1, -1, $_sort, 'desc', 5 - count($applications_categories), 0, $exclude_list);
            return array_merge($applications_categories, $applications_complement);
        }
        else
        {
            return $this->get_applications(true, -1, $_category_id, null, true, -1, -1, -1, $_sort, 'desc', 5);
        }
    }

    public function get_pour_les_gens_applications($_sort, $_category_id = -1)
    {
        return $this->get_applications(false, -1, $_category_id, null, true, -1, -1, -1, $_sort, 'desc', 5);
    }

    public function get_applications_compatibles($_pro, $_accessoire_id, $_page = 1)
    {
        return $this->get_applications($_pro, -1, -1, null, false, -1, -1, $_accessoire_id, 'id', 'desc', config_item('nb_results_list'), ($_page -1) * config_item('nb_results_list'));
    }

    public function get_number_applications_compatibles($_pro, $_accessoire_id)
    {
        return $this->db->join('accessoire_application_compatible AAC', 'AAC.application_id = A.id')
            ->where(array('AAC.accessoire_id' => $_accessoire_id, 'A.est_pro' => $_pro))
            ->count_all_results($this->table.' A');
    }

    public function get_applications_from_selection($_selection_id)
    {
        return $this->get_applications(null, -1, -1, null, false, -1, $_selection_id, -1);
    }

    public function get_notes_criteres_medappcare($_pro, $_application_id)
    {
        $notes_criteres_db = $this->db->select('note, critere_id, AC.parent_id')
            ->from($this->getTableName('notes_medappcare', $_pro).' NM')
            ->join($this->getTableName('criteres_medappcare', $_pro).' AC', 'AC.id = NM.critere_id', 'INNER')
            ->join('application_notation_medappcare ANM', 'ANM.id = NM.application_notation_id', 'INNER')
            ->where(array('ANM.application_id' => $_application_id))
            ->get()->result();
        $notes_criteres = array();
        foreach($notes_criteres_db as $note_criteres_db)
        {
            $notes_criteres[$note_criteres_db->critere_id] = $note_criteres_db->note;
            $notes_criteres[$note_criteres_db->parent_id] = isset($notes_criteres[$note_criteres_db->parent_id]) ?
                $notes_criteres[$note_criteres_db->parent_id] + $note_criteres_db->note : $note_criteres_db->note;
        }
        return $notes_criteres;
    }

    public function is_application_evaluated($_application_id)
    {
        $row = $this->db->get_where('application_notation_medappcare', array('application_id' => $_application_id))->row();
        return $row ? $row->id : false;
    }

    public function get_avis_from_application($_application_id)
    {
        $avis_row = $this->db->select('avis_'.config_item('lng').' AS avis')->get_where('application_notation_medappcare', array('application_id' => $_application_id))->row();
        return $avis_row ? $avis_row->avis : '';
    }

    public function get_application($_id)
    {
        return $this->db->select('A.*, A.note_medappcare AS note_medappcare_full, ROUND(A.note_medappcare) AS moyenne_note_medappcare,
                                E.nom AS nom_editeur, E.lien_contact, A.class, D.nom AS device_nom, D.class AS device_class')
            ->from($this->table.' A')
            ->join($this->tableEditeur.' E', 'E.id = A.editeur_id', 'INNER')
            ->join($this->tableDevice.' D', 'D.id = A.device_id', 'INNER')
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
        switch($_table)
        {
            case 'notes':
                return $_pro ? $this->tableNotesPro : $this->tableNotesPerso;
                break;
            case 'notation':
                return $_pro ? $this->tableNotationPro : $this->tableNotationPerso;
                break;
            case 'criteres':
                return $_pro ? $this->tableCriteresPro : $this->tableCriteresPerso;
                break;
            case 'notes_medappcare':
                return $_pro ? 'application_critere_note_medappcare_pro' : 'application_critere_note_medappcare_perso';
                break;
            case 'criteres_medappcare':
                return $_pro ? 'critere_application_medappcare_pro' : 'critere_application_medappcare_perso';
                break;
        }
    }

    public function get_notes_from_application($_pro, $_id, $_limit = 4, $_offset = 0)
    {
        $res = $this->db->select('M.id AS membre_id, C.nom_'.config_item('lng').' AS critere, N.commentaire_'.config_item('lng').' as commentaire, M.pseudo, N.date, NC.note, NC.critere_id')
            ->from($this->table.' A')
            ->join($this->getTableName('notation', $_pro).' N', 'N.application_id = A.id', 'LEFT')
            ->join($this->getTableName('notes', $_pro).' NC', 'NC.application_notation_id = N.id', 'INNER')
            ->join($this->getTableName('criteres', $_pro).' C', 'NC.critere_id = C.id', 'INNER')
            ->join('membre M', 'M.id = N.membre_id', 'INNER')
            ->group_by('M.id, NC.critere_id')
            ->limit($_limit, $_offset)
            ->where(array('A.id' => $_id))
            ->get()->result();
        $array_return =  $res ? $res : array();
        $return = array();
        foreach($array_return as $row_note)
        {
            if(!isset($return[$row_note->membre_id]))
            {
                $return[$row_note->membre_id] = new stdClass();
            }
            $return[$row_note->membre_id]->pseudo = $row_note->pseudo;
            $return[$row_note->membre_id]->commentaire = $row_note->commentaire;
            $return[$row_note->membre_id]->notes[] = $row_note;
        }
        return $return;
    }

    public function get_moyennes_from_application($_pro, $_id)
    {
        $res = $this->db->select('ROUND(AVG(2 * note)) / 2 AS note, C.nom_'.config_item('lng').' AS critere')
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
            $this->update_note_medappcare($_application_id);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function add_notes_medappcare_to_application($_application_id, $_notes, $_avis, $_pro)
    {
        if($notation_id = $this->is_application_evaluated($_application_id))
        {
            $this->db->delete($this->getTableName('notes_medappcare', $_pro), array('application_notation_id' => $notation_id));
            $this->db->delete('application_notation_medappcare', array('id' => $notation_id));
        }
        $this->db->set('application_id', $_application_id);
        $this->db->set('avis_'.config_item('lng'), $_avis);
        $this->db->set('date', 'NOW()', false);
        $notation_inserted = $this->db->insert('application_notation_medappcare');
        if($notation_inserted)
        {
            $notation_id = $this->db->insert_id();
            foreach($_notes as $critere_id => $note)
            {
                $this->db->set('application_notation_id', $notation_id);
                $this->db->set('critere_id', $critere_id);
                $this->db->set('note', $note);
                if(!$this->db->insert($this->getTableName('notes_medappcare', $_pro)))
                {
                    return false;
                }
            }
            $this->update_note_medappcare($_application_id);
            return true;
        }
        else
        {
            return false;
        }
    }

    public function get_number_notes_from_application($_pro, $_id)
    {
        return $this->db->where(array('application_id' => $_id))->count_all_results($this->getTableName('notation', $_pro));
    }

    public function get_application_push_from_categorie($_categorie_id)
    {
        $this->db->select('DISTINCT(A.id), A.nom, A.logo_url, A.titre')
            ->from($this->table.' A')
            ->join('application_categorie AC', 'AC.application_id = A.id', 'INNER')
            ->join($this->tableCategorie.' C', 'C.id = AC.categorie_id', 'INNER')
            ->where(array('est_liste' => 1, 'C.parent_id' => $_categorie_id, 'A.est_valide' => 1));
        $res = $this->db->get()->result();
        return !empty($res) ? $res : array();
    }

    public function get_next_appli($_application_id)
    {
        return $this->db->select('id')->limit(1)->get_where($this->table, 'id > '.$_application_id.' AND est_valide = 0')->row()->id;
    }

    public function get_prev_appli($_application_id)
    {
        return $this->db->select('id')->limit(1)->get_where($this->table, 'id < '.$_application_id.' AND est_valide = 0')->row()->id;
    }

}