<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/Common_Controller.php';
/*
 * @property Applications_model $Applications_model
 */
class Perso extends Common_Controller {

    public function __construct()
    {
        parent::__construct(false);
        $this->load->helper('country');
    }

	public function index()
	{
        $this->_common_index();
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

    public function category($_id)
    {
        $this->_common_category($_id);
    }

    public function app($_id)
    {
        $this->_common_app($_id);
    }
    
    public function mentionslegales()
	{
        $this->_common_mentionslegales();
	}
	
	public function contact()
    {
        $this->_common_contact();
    }
   
    public function device($_id)
    {
        $this->_common_device($_id);
    }

    public function news($_id)
    {
        $this->_common_news($_id);
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */