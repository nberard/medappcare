<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/Common_Controller.php';
/*
 * @property Applications_model $Applications_model
 */
class Gp extends Common_Controller {

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
        log_message('debug', "top5Applis=".var_export($top5Applis, true)."");
        $this->_format_all_links($top5Applis, 'app');
        $this->_populate_categories_applications($top5Applis);
        return $top5Applis;
    }

    protected function _display_last_eval()
    {
        $this->load->model('Applications_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications($this->pro);
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_format_all_notes($lastEvalApplis);
        $this->_populate_categories_applications($lastEvalApplis);
        return $lastEvalApplis;
    }

	public function index()
	{
        $this->_common_index(array(
            'applications' => $this->_display_last_eval(),
            'see_all_link' => $this->_format_link_no_id('app_search', 1, array('eval_medapp' => 1, 'sort' => 'date', 'order' => 'desc')),
        ), 'home_lasteval', array(
            'free' => false,
            'applications' => $this->_display_top_five(false),
            'template_render' => 'home_topfive',
            'see_all_link' => $this->_format_link_no_id('app_search', 1, array('free' => 0, 'eval_medapp' => 1)),
        ), 'home_topfive');
	}


    public function register()
    {
        $this->load->model('Plateformes_model');
        $plateformes = $this->Plateformes_model->get_all_plateformes();
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('membre'),
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
        if(!$user = $this->session->userdata('user'))
        {
            redirect('gp/index');
        }
        $this->load->model('Plateformes_model');
        $this->load->model('Membres_model');
        $user->categories = $this->Membres_model->get_categories_id_membre($user->id);
        $user->plateformes = $this->Membres_model->get_plateformes_id_membre($user->id);
        $user->plateformes_json = array();
        foreach($user->plateformes as $plateforme)
        {
            $user->plateformes_json[intval($plateforme)] = true;
        }
        $user->plateformes_json = json_encode($user->plateformes_json);

        $plateformes = $this->Plateformes_model->get_all_plateformes();
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('membre'),
        ));
        $espaceData['nb_countries'] = count(config_item('country_list'));
        $espaceData['country_json'] = country_json();
        $espaceData['plateformes'] = $plateformes;
        $espaceData['categories_principales'] =$data['inc']['data_categories_principales'];
        $user->date_naissance_classic = date_classic($user->date_naissance);
        $user->pays_full = get_full_country($user->pays);
        $espaceData['user'] = $user;
        log_message('debug', "user=".var_export($user, true)."");
        $data['contenu'] = $this->load->view('contenu/espace_membre', $espaceData, true);
        $data['body_class'] = 'membre '.$this->body_class;
        $this->load->view('main', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */