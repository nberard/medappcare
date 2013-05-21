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
        $this->_format_all_links($top5Applis, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');
        return $top5Applis;
    }

    protected function _display_last_eval()
    {
        $this->load->model('Applications_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications($this->pro);
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_format_all_links($lastEvalApplis, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');
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

    public function app_category($_categorie_id, $_page)
    {
        $offset = $_page-1;
        $this->load->model('Categories_model');
        $this->load->model('Applications_model');
        $search_params = $this->_get_all_search_params($_GET);
        log_message('debug', "search_params=".var_export($search_params, true));

        $categorie = $this->Categories_model->get_categorie($_categorie_id);
        $applications = $this->Applications_model->get_applications_from_categorie($this->pro, $search_params['devices'], $_categorie_id, $search_params['free'], $search_params['sort'], $search_params['order'], $offset * config_item('nb_results_list'));
        $this->_format_all_prices($applications);
        $this->_format_all_notes($applications);
        $this->_format_all_links($applications, 'app');
        $this->_format_all_links($applications, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');

        if(count($applications) == config_item('nb_results_list'))
        {
            $this->_format_link($categorie, 'app_category', 'nom', 'link_all_next', 'id' ,$_page+1, $search_params);
        }
        if($_page > 1)
        {
            $this->_format_link($categorie, 'app_category', 'nom', 'link_all_prev', 'id' ,$_page-1, $search_params);
        }
        $this->load->model('Devices_model');
        $devices = $this->Devices_model->get_all_devices();

        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-multiselect'),
            js_url('search'),
        ));

        $data['contenu'] = $this->load->view('contenu/list_app', array(
            'app_grid' => $this->load->view('inc/app_grid', array(
                'applications' => $applications,
            ), true),
            'categorie' => $categorie,
            'devices' => $devices,
            'search_params' => $search_params,
        ), true);
        $data['body_class'] = 'category '.$this->body_class.' '.$categorie->class;
        $this->load->view('main', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */