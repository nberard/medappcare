<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/Common_Controller.php';
/*
 * @property Applications_model $Applications_model
 */
class Pro extends Common_Controller {

    public function __construct()
    {
        parent::__construct(true);
        $user = $this->session->userdata('user');
        if($this->router->fetch_method() != 'register' && (!$user || $user->est_pro != 1))
        {
            redirect(index_page());
        }
    }

    protected function _display_pour_les_pros($_filtre = 'date')
    {
        $this->load->model('Applications_model');
        $top5Applis = $this->Applications_model->get_top_five_applications(false, true);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_links($top5Applis, 'app');
        $this->_populate_categories_applications($top5Applis);
        return $top5Applis;
    }

    protected function _display_pour_les_gens($_filtre = 'note')
    {
        $this->load->model('Applications_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications(true);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_populate_categories_applications($lastEvalApplis);
        return $lastEvalApplis;
    }


    public function index()
    {
        $this->_common_index(array(
            'applications' => $this->_display_pour_les_pros(),
        ), 'pro_pourlespros', array(
            'applications' => $this->_display_pour_les_gens(),
        ), 'pro_pourlesgens');
    }

    public function register()
    {
        $this->load->helper('form');
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('registerPro'),
        ));
        $data['contenu'] = $this->load->view('contenu/registerPro', '', true);
        $data['body_class'] = 'signup '.$this->body_class;
        $this->load->view('main', $data);
    }

    public function espacemembre()
    {
        $this->load->helper('form');
        $user = $this->session->userdata('user');
        $this->load->model('Membres_model');
        $user->categories = $this->Membres_model->get_categories_id_membre($user->id);
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('registerPro'),
        ));
        $espaceData['categories_principales'] =$data['inc']['data_categories_principales'];
        $espaceData['user'] = $user;
        $data['contenu'] = $this->load->view('contenu/espace_membre_pro', $espaceData, true);
        $data['body_class'] = 'membre '.$this->body_class;
        $this->load->view('main', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */