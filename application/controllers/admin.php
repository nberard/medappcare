<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 26/03/13
 * Time: 18:21
 */
class Admin extends CI_Controller
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
        $this->load->helper('country');
        $this->load->helper('crypt');
        $this->load->library('grocery_CRUD');
        $this->load->library('log');
        $this->crud = new grocery_CRUD();
        $this->crud->set_theme('twitter-bootstrap');
        $this->output->enable_profiler(TRUE);
    }

    public function _admin_output($output = null)
    {
        $this->load->view('admin.php',$output);
    }

    public function index()
    {
        $this->_admin_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
    }

    public function pages()
    {
        $this->crud->set_subject('Page');
        $this->crud->set_table('page');
        $this->crud->required_fields('nom');
        $this->crud->fields(array('nom', 'contenu'));
        $this->crud->callback_after_insert(array($this, '_pages_after_add'));
        $this->crud->callback_after_update(array($this, '_pages_after_add'));
        $this->_admin_output($this->crud->render());
    }

    public function accessoires()
    {
        $this->crud->set_subject('Accessoire');
        $this->crud->set_table('accessoire');
        $this->crud->required_fields('nom', 'fabriquant_id', 'photo', 'lien_achat');
        $this->crud->set_relation('fabriquant_id', 'accessoire_fabriquant', '{nom}');
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
        $this->crud->required_fields('titre');
        $this->crud->set_relation('categorie_id', 'categorie', '{nom}');
        $this->crud->set_relation('device_id', 'device', '{nom}');
        $this->crud->unset_fields('date_creation', 'date_modification');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $updates = array("date_creation" => date('Y-m-d H:i:s'));
            $this->_handle_default_values($post_array,$primary_key,array('categorie_id' => -1, 'device_id' => -1), 'article', $updates);
            $this->log->write_log('ERROR', 'res='.var_export($updates,true).'');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $updates = array("date_modification" => date('Y-m-d H:i:s'));
            $this->_handle_default_values($post_array,$primary_key,array('categorie_id' => -1, 'device_id' => -1), 'article', $updates);
        });

        $this->_admin_output($this->crud->render());
    }

    function _article_commentaires_after_add($post_array,$primary_key)
    {
        $this->db->update('article_commentaire',array("date" => date('Y-m-d H:i:s')), array('id' => $primary_key));
        return true;
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
        $this->crud->required_fields('nom', 'logo_url', 'est_pro');
        $this->crud->set_relation('parent_id', 'categorie', '{nom}');
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
        $this->crud->required_fields('nom', 'est_premium');
        $this->_admin_output($this->crud->render());
    }

    public function membres()
    {
        $this->crud->set_subject("Membre");
        $this->crud->set_table('membre');
        $this->crud->required_fields('email', 'est_pro');
        if($this->crud->getState() == 'insert_validation')
        {
            $this->crud->required_fields('email', 'est_pro', 'mot_de_passe');
        }
        else
        {
            $this->crud->required_fields('email', 'est_pro');
        }
        $this->crud->set_relation('device_id', 'device', '{nom}');
        $this->crud->field_type('sexe','enum',array('M', 'F'));
        $this->crud->set_rules('email', 'E-mail', 'valid_email|required');
        $this->crud->callback_edit_field('mot_de_passe', function($value){
            return '<input type="text" name="mot_de_passe"/>';
        });
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('cgu_valid' => 0, 'cgv_valid' => 0, 'newsletter' => 0, 'device_id' => -1, 'droits' => 0),
                'membre');
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,
                array('cgu_valid' => 0, 'cgv_valid' => 0, 'newsletter' => 0, 'device_id' => -1, 'droits' => 0),
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
        $this->_admin_output($this->crud->render());
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
            if(!isset($_post_array[$field]))
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
        $this->crud->required_fields('nom', 'date_debut', 'date_debut' ,'evennement');
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
        $this->crud->set_relation('categorie_id', 'categorie', '{nom}');
        $this->crud->set_relation_n_n('applications', 'selection_application', 'application', 'selection_id', 'application_id', '{nom}');
        $this->_admin_output($this->crud->render());
    }

    public function applications()
    {
        $this->crud->set_subject("Application");
        $this->crud->set_table('application');
        $this->crud->required_fields('nom', 'package', 'device_id' , 'logo_url', 'titre', 'date_ajout', 'prix', 'devise', 'langue_store', 'editeur_id', 'lien_download');
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
        $this->crud->set_relation('categorie_id', 'categorie', '{nom}');
        $this->_admin_output($this->crud->render());
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

    public function application_notes()
    {
        $this->crud->set_subject("Note d'application (utilisateur)");
        $this->crud->set_table('application_note');
        $this->crud->required_fields('membre_id', 'application_id', 'note');
        $this->crud->callback_after_insert(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array(),'application_note', array("date" => date('Y-m-d H:i:s')));
        });
        $this->crud->callback_after_update(function($post_array,$primary_key) {
            $this->_handle_default_values($post_array,$primary_key,array(),'application_note', array("date" => date('Y-m-d H:i:s')));
        });
        $this->crud->set_relation('membre_id', 'membre', '{email}');
        $this->crud->set_relation('application_id', 'application', '{nom}');
        $this->crud->change_field_type('commentaire', 'text');
        $this->crud->field_type('note','enum',range(config_item('note_min'), config_item('note_max')));
        $this->_admin_output($this->crud->render());
    }

    public function application_screenshots()
    {
        $this->crud->set_subject("Screenshot d'application");
        $this->crud->set_table('application_screenshot');
        $this->crud->required_fields('application_id', 'url');
        $this->crud->set_relation('application_id', 'application', '{nom}');
        $this->_admin_output($this->crud->render());
    }

    public function application_notes_critere()
    {
        echo 'TODO';
    }
}
