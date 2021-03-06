<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 */
class Admin extends MY_Controller
{
    private $crud;

    public function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!$user || $user->droits != 1)
        {
            redirect(index_page());
        }
        $this->load->database();
        $this->load->helper('url');
        $this->config->load('country');
        $this->load->helper('assets');
        $this->load->helper('country');
        $this->load->helper('crypt');
        $this->load->library('grocery_CRUD');
        $this->load->library('log');
        $this->crud = new grocery_CRUD();
        $this->crud->set_theme('twitter-bootstrap');
        if(ENVIRONMENT == 'development')
        {
            $this->output->enable_profiler(TRUE);
        }
    }

    public function _admin_output($output = null)
    {
        $this->load->view('admin/admin.php',$output);
    }

    public function index()
    {
        $this->load->model('Membres_model');
        $membres_attente = $this->Membres_model->get_membres_attente();
        $this->load->model('Applications_model');
        $applis_attente = $this->Applications_model->get_applications_attente();
        $this->_admin_output((object)array('output' =>
           $this->load->view('admin/links', array(
                                                      'membres_attente' => $membres_attente,
                                                      'applis_attente' => $applis_attente,
                                                 ), true)
        , 'js_files' => array() , 'css_files' => array()));
    }

    public function medappcare($_application_id)
    {
        $this->load->model('Applications_model');
        $pro = $this->Applications_model->is_application_pro($_application_id);
        if(!empty($_POST))
        {
            $this->load->library('form_validation');
            $this->lang->load('form_validation');
            $notes = array();
            $avis = '';
            $this->form_validation->set_rules('avis', 'Avis', 'required');
            foreach($_POST as $key => $value)
            {
                if(substr($key, 0, 4) == 'note' && is_numeric($critere_id = substr($key, 4)) && $value != "")
                {
                    $this->form_validation->set_rules('note'.$critere_id, 'Note', 'is_natural|less_than['.(config_item('note_max_medappcare') + 1).']');
                    $notes[$critere_id] = $value;
                }
                elseif($key == 'avis')
                {
                    $avis = $value;
                }
            }
            if(!$this->form_validation->run())
            {
                $errors = $this->_validation_get_errors();
                foreach($errors as $error)
                {
                    $this->session->set_flashdata('error', $error);
                }
            }
            else if(count($notes) == 0)
            {
                $this->session->set_flashdata('error', "Une note minimum est requise");
            }
            else
            {
                if($this->Applications_model->add_notes_medappcare_to_application($_application_id, $notes, $avis, $pro))
                {
                    $this->session->set_flashdata('success', 'Note Medappcare mise à jour');
                }
                else
                {
                    $this->session->set_flashdata('error', "Erreur dans l'insertion de la note");
                }
            }
            redirect('admin/medappcare/'.$_application_id,'refresh');
        }
        $this->load->model('Applications_model');
        $criteres = $this->Applications_model->get_criteres_medappcare($pro);
        $application = $this->Applications_model->get_application($_application_id);
        if($application->note_medappcare > 0.00)
        {
            $notes_criteres = $this->Applications_model->get_notes_criteres_medappcare($application->est_pro, $_application_id);
            $avis = $this->Applications_model->get_avis_from_application($_application_id);
        }
        else
        {
            $notes_criteres = array();
            $avis = '';
        }
//        log_message('debug', "notes_criteres=".var_export($notes_criteres, true));
        $this->load->helper('assets');
        $js_files = array(
            js_url('jquery-2.0.0.min'),
            base_url('assets/grocery_crud/texteditor/ckeditor/ckeditor.js'),
            base_url('assets/grocery_crud/texteditor/ckeditor/adapters/jquery.js'),
            base_url('assets/grocery_crud/js/jquery_plugins/config/jquery.ckeditor.config.js'),
        );
        $this->_admin_output((object)array('output' => $this->load->view('admin/medappcare', array(
            'avis' => $avis,
            'criteres' => $criteres,
            'notes_criteres' => $notes_criteres,
        ), true) , 'js_files' => $js_files , 'css_files' => array(css_url('bootstrap'))));
    }

    public function pages()
    {
        $this->crud->set_subject('Page');
        $this->crud->set_table('page');
        $this->crud->required_fields('nom');
        $this->crud->fields(array('nom', 'contenu_fr', 'contenu_en'));
        $this->crud->callback_after_insert(array($this, '_pages_after_add'));
        $this->crud->callback_after_update(array($this, '_pages_after_add'));
        $this->_admin_output($this->crud->render());
    }

    public function accessoire_photos()
    {
        $this->crud->set_subject("Photo d'accessoires");
        $this->crud->set_table('accessoire_photo');
        $upload_paths = config_item('upload_paths');
        $this->crud->set_field_upload('photo',$upload_paths['accessoire']);
        $this->crud->set_relation('accessoire_id', 'accessoire', '{nom_'.config_item('lng').'}');
        $this->_admin_output($this->crud->render());
    }

    public function accessoires()
    {
        $this->config->load('price');
        $this->crud->set_subject('Accessoire');
        $this->crud->set_table('accessoire');
        $this->crud->field_type('devise','enum',array_keys(config_item('currency_map')));
        $this->crud->field_type('type','enum', config_item('types_accessoires'));
        $this->crud->required_fields('nom_'.config_item('lng'), 'fabriquant_id', 'photo', 'lien_achat');
        $this->crud->set_relation('fabriquant_id', 'accessoire_fabriquant', '{nom}');

        $this->crud->set_relation_n_n('applications', 'accessoire_application_compatible', 'application', 'accessoire_id', 'application_id', '{nom}');

        $this->_admin_output($this->crud->render());
    }

    public function accessoire_commentaires()
    {
        $this->crud->set_subject("Commentaire d'accessoire");
        $this->crud->set_table('accessoire_commentaire');
        $this->crud->required_fields('accessoire_id', 'membre_id', 'est_suspendu');
        $this->crud->set_relation('membre_id', 'membre', '{email}');
        $this->crud->set_relation('accessoire_id', 'accessoire', '{nom_'.config_item('lng').'}');
        $this->crud->unset_fields('date');
        $this->crud->change_field_type('contenu', 'text');
        $this->crud->callback_after_insert(array($this, '_accessoire_commentaires_after_add'));
        $this->crud->callback_after_update(array($this, '_accessoire_commentaires_after_add'));
        $this->_admin_output($this->crud->render());
    }

    function _pages_after_add($post_array,$primary_key)
    {
        $this->db->update('page',array("date_modification" => date('Y-m-d H:i:s')), array('id' => $primary_key));
        return true;
    }

    public function accessoire_fabriquants()
    {
        $this->crud->set_subject("Fabriquant d'accessoires");
        $this->crud->set_table('accessoire_fabriquant');
        $this->crud->required_fields('nom');
        $this->_admin_output($this->crud->render());
    }

    public function articles()
    {
        $this->crud->set_subject('Article');
        $this->crud->set_table('article');
        $this->crud->required_fields('titre_'.config_item('lng'));
        $this->crud->set_relation('categorie_id', 'article_categorie', '{nom_'.config_item('lng').'}');
        $this->crud->unset_fields('date_creation', 'date_modification');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $updates = array("date_creation" => date('Y-m-d H:i:s'));
            $this->_handle_default_values($post_array,$primary_key,array('categorie_id' => -1), 'article', $updates);
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $updates = array("date_modification" => date('Y-m-d H:i:s'));
            $this->_handle_default_values($post_array,$primary_key,array('categorie_id' => -1), 'article', $updates);
        });

        $this->_admin_output($this->crud->render());
    }

    function _article_commentaires_after_add($post_array,$primary_key)
    {
        $this->db->update('article_commentaire',array("date" => date('Y-m-d H:i:s')), array('id' => $primary_key));
        return true;
    }

    function _accessoire_commentaires_after_add($post_array,$primary_key)
    {
        $this->db->update('article_commentaire',array("date" => date('Y-m-d H:i:s')), array('id' => $primary_key));
        return true;
    }

    public function article_categories()
    {
        $this->crud->set_subject("Categories d'article");
        $this->crud->set_table('article_categorie');
        $this->crud->required_fields('nom_'.config_item('lng'));
        $this->_admin_output($this->crud->render());
    }

    public function article_commentaires()
    {
        $this->crud->set_subject("Commentaire d'article");
        $this->crud->set_table('article_commentaire');
        $this->crud->required_fields('membre_id', 'article_id', 'membre_id', 'est_suspendu');
        $this->crud->set_relation('membre_id', 'membre', '{email}');
        $this->crud->set_relation('article_id', 'article', '{titre}');
        $this->crud->unset_fields('date');
        $this->crud->change_field_type('contenu', 'text');
        $this->crud->callback_after_insert(array($this, '_article_commentaires_after_add'));
        $this->crud->callback_after_update(array($this, '_article_commentaires_after_add'));
        $this->_admin_output($this->crud->render());
    }


    function _categories_after_add($post_array,$primary_key)
    {
        $this->_handle_default_values($post_array, $primary_key, array('parent_id' => -1, 'poids' => 0), 'categorie');
        return true;
    }

    public function categories()
    {
        $this->crud->set_subject("Catégorie");
        $this->crud->set_table('categorie');
        $this->crud->field_type('class','enum',config_item('body_class_categories'));
        $this->crud->required_fields('nom_'.config_item('lng'), 'est_pro');
        $this->crud->set_relation('parent_id', 'categorie', '{nom_'.config_item('lng').'} (pro:{est_pro})', array('parent_id' => -1));
        $this->crud->callback_after_insert(array($this, '_categories_after_add'));
        $this->crud->callback_after_update(array($this, '_categories_after_add'));
        $this->_admin_output($this->crud->render());
    }

    public function devices()
    {
        $this->crud->set_subject("Device");
        $this->crud->set_table('device');
        $this->crud->required_fields('nom', 'logo');
        $this->_admin_output($this->crud->render());
    }

    public function editeurs()
    {
        $this->crud->set_subject("Editeur");
        $this->crud->set_table('editeur');
        $this->crud->unset_fields('est_premium');
        $this->crud->required_fields('nom');
        $this->_admin_output($this->crud->render());
    }

    public function plateformes()
    {
        $this->crud->set_subject("Plateforme");
        $this->crud->set_table('plateforme');
        $this->crud->required_fields('label_'.config_item('lng'));
        $this->crud->set_relation('device_id', 'device', '{nom}');
        $this->_admin_output($this->crud->render());
    }

    public function membres()
    {
        $this->crud->set_subject("Membre");
        $this->crud->set_table('membre');
        $this->crud->required_fields('email', 'est_pro');
        $this->crud->set_relation_n_n('plateformes', 'membre_plateforme', 'plateforme', 'membre_id', 'plateforme_id', '{label_'.config_item('lng').'}');
        $this->crud->set_relation_n_n('categories', 'membre_categorie', 'categorie', 'membre_id', 'categorie_id', '{nom_'.config_item('lng').'}', '', array('parent_id !=' => -1));
//        public function set_relation_n_n($field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table, $primary_key_alias_to_selection_table , $title_field_selection_table , $priority_field_relation_table = null, $where_clause = null)
        if($this->crud->getState() == 'insert_validation')
        {
            $this->crud->required_fields('email', 'est_pro', 'mot_de_passe');
        }
        else
        {
            $this->crud->required_fields('email', 'est_pro');
        }
        $this->crud->field_type('sexe','enum',array('H', 'F', 'A'));
        $metiers = config_item('metiers');
        $this->crud->field_type('profession','enum',array_keys($metiers["Profession Médicale"]) + array_keys($metiers["Profession Paramédicale"]));
        $this->crud->set_rules('email', 'E-mail', 'valid_email|required');
        $this->crud->callback_edit_field('mot_de_passe', function($value){
            return '<input type="text" name="mot_de_passe"/>';
        });
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('cgu_valid' => 0, 'cgv_valid' => 0, 'newsletter' => 0, 'droits' => 0, 'date_creation' => date('Y-m-d')),
                'membre');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('cgu_valid' => 0, 'cgv_valid' => 0, 'newsletter' => 0, 'droits' => 0),
                'membre');
        });
        $this->crud->callback_add_field('pays', function($value = '', $primary_key = null){
            return country_dropdown('pays', array('FR'));
        });
        $this->crud->callback_edit_field('pays', function($value = '', $primary_key = null){
            return country_dropdown('pays', array('FR'), $value);
        });
        $this->crud->callback_before_insert(array($this, '_membres_before_action'));
        $this->crud->callback_before_update(array($this, '_membres_before_action'));

        $this->crud->callback_column('date_creation',array($this,'_callback_date_creation'));
        $this->crud->display_as('droits','Droit Admin');
        $this->_admin_output($this->crud->render());
    }

    public function _callback_date_creation($value, $row)
    {
        $this->load->helper('date');
        $diff = abs(strtotime(date('Y-m-d')) - strtotime($value));
        $nb_jours = floor($diff / (60*60*24));
        $class = $row->est_pro == 2 && $nb_jours > config_item('nb_jours_max_inscription_pro') ? 'warn' : '';
       return '<span class="'.$class.'">'.date_classic($value).'</span>';
    }

    function _membres_before_action($post_array)
    {
        if(empty($post_array['mot_de_passe']))
        {
            unset($post_array['mot_de_passe']);
        }
        else
        {
            $post_array['mot_de_passe'] = get_crypt_password($post_array['mot_de_passe']);
        }
        return $post_array;
    }

    private function _handle_default_values($_post_array,$_primary_key,$_to_check, $_table, $_updates = array(), $_id = 'id')
    {
        foreach($_to_check as $field => $default_value)
        {
            if(empty($_post_array[$field]))
            {
                $_updates[$field] = $default_value;
            }
        }
        if(!empty($_updates))
        {
            $this->db->update($_table, $_updates, array($_id => $_primary_key));
        }
    }

    public function publicites()
    {
        $this->crud->set_subject("Publicité");
        $this->crud->set_table('publicite');
        $this->crud->required_fields('nom_symbolique', 'lien', 'image_url');
        $this->_admin_output($this->crud->render());
    }

    public function selections()
    {
        $this->crud->set_subject("Sélection");
        $this->crud->set_table('selection');
        $this->crud->required_fields('nom', 'date_debut', 'date_debut' ,'evennement', 'type');
        $this->crud->display_as('type_selection','(inactif => applications ; actif => accessoires)');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('categorie_id' => -1, 'poids' => 0),
                'selection');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('categorie_id' => -1, 'poids' => 0),
                'selection');
        });
        $this->crud->set_relation('categorie_id', 'categorie', '{nom_'.config_item('lng').'}');
//        set_relation_n_n($field_name, $relation_table, $selection_table, $primary_key_alias_to_this_table, $primary_key_alias_to_selection_table , $title_field_selection_table , $priority_field_relation_table = null, $where_clause = null)
        $this->crud->set_relation_n_n('accessoires', 'selection_accessoire', 'accessoire', 'selection_id', 'accessoire_id', '{nom_'.config_item('lng').'}');
        $this->crud->set_relation_n_n('applications', 'selection_application', 'application', 'selection_id', 'application_id', '{nom}');
        $upload_paths = config_item('upload_paths');
        $this->crud->set_field_upload('image',$upload_paths['selection']);
        $this->crud->change_field_type('description', 'text');
        $this->_admin_output($this->crud->render());
    }

    public function _applications_after_action($post_array)
    {
        $this->load->model('Categories_model');
        $gp_ids = $this->Categories_model->get_categories_gp_ids();
        if(count(array_intersect($gp_ids, $post_array['categories'])) && !in_array(Categories_model::CATEGORY_ALL_GP, $post_array['categories'])) {
            $this->db->insert('application_categorie', array('application_id' => $this->crud->getStateInfo()->primary_key, 'categorie_id' => Categories_model::CATEGORY_ALL_GP));
        }
        return true;
    }

    public function applications()
    {
        $this->crud->set_subject("Application");
        $this->crud->set_table('application');
        $this->crud->required_fields('nom', 'package', 'device_id' , 'logo_url', 'titre', 'date_ajout', 'prix', 'devise', 'langue_store', 'editeur_id', 'lien_download');
        $this->crud->set_relation('device_id', 'device', '{nom}');
        $this->crud->set_relation('editeur_id', 'editeur', '{nom}');
        $this->crud->callback_after_insert(array($this, '_applications_after_action'));
        $this->crud->callback_after_update(array($this, '_applications_after_action'));
        if($this->crud->getState() != 'list')
        {
            $this->crud->set_relation_n_n('accessoires', 'accessoire_application_compatible', 'accessoire', 'application_id', 'accessoire_id', '{nom_'.config_item('lng').'}');
            $this->crud->set_relation_n_n('categories', 'application_categorie', 'categorie', 'application_id', 'categorie_id', '{nom_'.config_item('lng').'} (pro:{est_pro})');
        }
        $this->crud->field_type('class','enum',config_item('body_class_categories'));
        $this->crud->add_action('Notation Medappcare', '', config_item('lng').'/admin/medappcare','ui-icon-plus');
        $this->crud->callback_column('logo_url',array($this,'_callback_logo_url'));
        $this->crud->callback_column('lien_download',array($this,'_callback_webpage_url'));
        $this->crud->callback_column('est_valide',array($this,'_callback_valide'));
        $this->crud->callback_edit_field('logo_url',array($this,'_callback_logo_url_edit'));
        $this->crud->callback_edit_field('lien_download',array($this,'_callback_webpage_url_edit'));
        $this->crud->unset_columns('package', 'description', 'date_ajout', 'langue_appli', 'version', 'mots_cles',
                                    'est_penalisee', 'mot_editeur', 'presse', 'titre');
        $this->crud->display_as('est_liste','application sponsorisée')
            ->display_as('est_valide','valide ? (0 => non ; 1 => oui ; 2 => supprimée)')
            ->display_as('est_ce','application CE')
            ->display_as('class','couleur de catégorie');
        $this->crud->field_type('est_valide','enum',array(0,1,2));
        $this->crud->limit(20);
        $this->crud->unset_edit_fields('package', 'date_ajout', 'langue_appli', 'version', 'mots_cles', 'note_medappcare', 'est_penalisee');
        $output = $this->crud->render();
        if(isset($this->crud->getStateInfo()->primary_key))
        {
            $this->load->model('Applications_model');
            $sup = $this->Applications_model->get_next_appli($this->crud->getStateInfo()->primary_key);
            $inf = $this->Applications_model->get_prev_appli($this->crud->getStateInfo()->primary_key);
            $output->current = $this->crud->getStateInfo()->primary_key;
            $output->sup = $sup;
            $output->inf = $inf;
        }

        $this->_admin_output($output);
    }

    public function _callback_valide($value, $row)
    {
        $class = $value == 0 ? 'warn' : '';
        return '<span class="'.$class.'">'.$value.'</span>';
    }

    public function _callback_webpage_url($value, $row)
    {
        return "<a href='".$value."'>$value</a>";
    }

    public function _callback_webpage_url_edit($value, $row)
    {
        return '<a href="'.$value.'">'.$value.'</a><br/><input id="field-lien_download" name="lien_download" type="text" value="'.$value.'" maxlength="1024">';
    }

    public function _callback_logo_url($value, $row)
    {
        return "<img src='".$value."'/>";
    }

    public function _callback_logo_url_edit($value, $row)
    {
        return '<img src="'.$value.'"/><br/><input id="field-logo_url" name="logo_url" type="text" value="'.$value.'" maxlength="1024">';
    }

    public function application_commentaires()
    {
        $this->crud->set_subject("Commentaire d'application");
        $this->crud->set_table('application_commentaire');
        $this->crud->required_fields('membre_id', 'application_id', 'contenu');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('est_suspendu' => 0),'application_commentaire', array("date" => date('Y-m-d H:i:s')));
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('est_suspendu' => 0),'application_commentaire', array("date" => date('Y-m-d H:i:s')));
        });
        $this->crud->set_relation('membre_id', 'membre', '{email}');
        $this->crud->set_relation('application_id', 'application', '{nom}');
        $this->crud->change_field_type('contenu', 'text');
        $this->_admin_output($this->crud->render());
    }

    public function application_screenshots()
    {
        $this->crud->set_subject("Screenshot d'application");
        $this->crud->set_table('application_screenshot');
        $this->crud->required_fields('application_id', 'url');
        $this->crud->callback_column('url',array($this,'_callback_logo_url'));
        $this->crud->set_relation('application_id', 'application', '{nom}');
        $this->_admin_output($this->crud->render());
    }

    public function application_commentaires_medappcare()
    {
        $this->crud->set_subject("Commentaire Medappcare");
        $this->crud->set_table('application_notation_medappcare');
        $this->crud->set_relation('application_id', 'application', '{nom}');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array(),'application_notation_medappcare', array("date" => date('Y-m-d H:i:s')));
        });
        $this->_admin_output($this->crud->render());
    }

    public function  application_notes_medappcare_gp()
    {
        $this->crud->set_subject("Note Medappcare gp");
        $this->crud->set_table('application_critere_note_medappcare_gp');
        $this->crud->set_relation('application_notation_id', 'application_notation_medappcare', '{id} ({date}) : {avis_'.config_item('lng').'}');
        $this->crud->set_relation('critere_id', 'critere_application_medappcare_gp', '{nom_'.config_item('lng').'} ({poids_pourcent} %)', 'parent_id != -1');
        $this->_admin_output($this->crud->render());
    }

    public function  application_notes_medappcare_pro()
    {
        $this->crud->set_subject("Note Medappcare pro");
        $this->crud->set_table('application_critere_note_medappcare_pro');
        $this->crud->set_relation('application_notation_id', 'application_notation_medappcare', '{id} ({date}) : {avis_'.config_item('lng').'}');
        $this->crud->set_relation('critere_id', 'critere_application_medappcare_pro', '{nom_'.config_item('lng').'} ({poids_pourcent} %)', 'parent_id != -1');
        $this->_admin_output($this->crud->render());
    }

    public function  application_criteres_medappcare_pro()
    {
        $this->crud->set_subject("Critères Medappcare pro");
        $this->crud->set_table('critere_application_medappcare_pro');
        $this->crud->set_relation('parent_id', 'critere_application_medappcare_pro', '{nom_'.config_item('lng').'}', 'parent_id = -1');
        $this->_admin_output($this->crud->render());

        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('parent_id' => -1),'critere_application_medappcare_pro');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('parent_id' => -1),'critere_application_medappcare_pro');
        });
    }

    public function  application_criteres_medappcare_gp()
    {
        $this->crud->set_subject("Critères Medappcare gp");
        $this->crud->set_table('critere_application_medappcare_gp');
        $this->crud->set_relation('parent_id', 'critere_application_medappcare_gp', '{nom_'.config_item('lng').'}', 'parent_id = -1');
        $this->_admin_output($this->crud->render());

        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('parent_id' => -1),'critere_application_medappcare_gp');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array('parent_id' => -1),'critere_application_medappcare_gp');
        });
    }


}
