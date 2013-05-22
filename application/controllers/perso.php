<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/Common_Controller.php';
/*
 * @property Applications_model $Applications_model
 */
class Perso extends Common_Controller {

    public function __construct()
    {
        parent::__construct(false);
        $user = $this->session->userdata('user');
        if($user && $user->est_pro == 1)
        {
            redirect(site_url('pro/index'));
        }
        $this->load->helper('country');
    }

    protected function _display_top_five($_free)
    {
        $this->load->model('Applications_model');
        $top5Applis = $this->Applications_model->get_top_five_applications($_free, false);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_notes($top5Applis);
        $this->_format_all_links($top5Applis, 'app');
        $this->_populate_categories_application($top5Applis);
        return $top5Applis;
    }

    protected function _display_last_eval()
    {
        $this->load->model('Applications_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications($this->pro);
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_populate_categories_application($lastEvalApplis);
        return $lastEvalApplis;
    }

	public function index()
	{
        $this->_common_index($this->_display_last_eval(), 'home_lasteval', $this->_display_top_five(false), 'home_topfive');
	}


    public function register()
    {
        $this->load->model('Plateformes_model');
        $plateformes = $this->Plateformes_model->get_all_plateformes();
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('register'),
        ));
        $registerData['nb_countries'] = count(config_item('country_list'));
        $registerData['country_json'] = country_json();
        $registerData['plateformes'] = $plateformes;
        $registerData['categories_principales'] =$data['inc']['data_categories_principales'];
        $data['contenu'] = $this->load->view('contenu/register', $registerData, true);
        $data['body_class'] = 'signup '.$this->body_class;
        $this->load->view('main', $data);
    }

    public function espacemembre()
    {
        $this->load->model('Plateformes_model');
        $plateformes = $this->Plateformes_model->get_all_plateformes();
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('register'),
        ));
        $espaceData['nb_countries'] = count(config_item('country_list'));
        $espaceData['country_json'] = country_json();
        $espaceData['plateformes'] = $plateformes;
        $espaceData['categories_principales'] =$data['inc']['data_categories_principales'];
        $data['contenu'] = $this->load->view('contenu/espace_membre', $espaceData, true);
        $data['body_class'] = 'membre '.$this->body_class;
        $this->load->view('main', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */