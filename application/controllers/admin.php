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
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('grocery_CRUD');
        $this->crud = new grocery_CRUD();
        $this->crud->set_theme('twitter-bootstrap');
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
        $this->crud->set_table('page');
        $this->crud->required_fields('nom');
        $this->crud->fields(array('nom', 'contenu'));
        $this->crud->callback_after_insert(array($this, '_pages_after_add'));
        $this->crud->callback_after_update(array($this, '_pages_after_add'));
        $this->_admin_output($this->crud->render());
    }

    public function accessoires()
    {
        $this->crud->set_table('accessoire');
        $this->crud->required_fields('nom', 'fabriquant_id', 'photo', 'lien_achat');
        $this->crud->set_relation('fabriquant_id', 'accessoire_fabriquant', '{nom}');
        $this->crud->set_rules('lien_achat', '', 'prep_url');
        $this->_admin_output($this->crud->render());
    }

    function _pages_after_add($post_array,$primary_key)
    {
        $this->db->update('page',array("date_modification" => date('Y-m-d H:i:s')), array('nom' => $primary_key));
        return true;
    }
}
