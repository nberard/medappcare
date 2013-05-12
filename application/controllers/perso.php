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
        log_message('debug', "index");
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $this->lang->load('common');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications();
        $top5Applis = $this->Applications_model->get_top_five_applications();
        //var_dump($this->Applications_model->get_selection_applications(1));
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_format_all_links($top5Applis, 'app');

        $this->load->model('Devices_model');
        $this->load->model('Articles_model');
        $articles = $this->Articles_model->get_last_articles(2);
        foreach ($articles as $article)
        {
            $article->date_full = date_full($article->date_creation);
        }
        $this->_format_all_links($articles, 'news', "titre_".config_item('language_short'));
        $this->_format_all_links($articles, 'category', 'nom_categorie', 'categorie_link', 'categorie_id');


        $indexData = array(
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'home_lasteval' => $this->load->view('inc/home_lasteval', array(
                'applications' => $lastEvalApplis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'home_topfive' => $this->load->view('inc/home_topfive', array(
                'applications' => $top5Applis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'widget_news' => $this->load->view('inc/widget_news', array('articles' => $articles), true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/index', $indexData, true);
        $data['body_class'] = 'homepage particuliers';
		$this->load->view('main', $data);
	}


    public function register()
    {
        $this->load->model('Plateformes_model');
        $plateformes = $this->Plateformes_model->get_all_plateformes();
        $data['inc'] = $this->_getCommonIncludes(false, array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('register'),
        ));
        $registerData['nb_countries'] = count(config_item('country_list'));
        $registerData['country_json'] = country_json();
        $registerData['plateformes'] = $plateformes;
        $registerData['categories_principales'] = $data['inc']['data_categories_principales'];
        $registerData['categories_enfants_assoc'] = $data['inc']['data_categories_enfants_assoc'];
        $data['contenu'] = $this->load->view('contenu/register', $registerData, true);
        $data['body_class'] = 'signup particuliers';
        $this->load->view('main', $data);
    }

    public function category($_id)
    {
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $this->load->model('Categories_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications($_id);
        $top5Applis = $this->Applications_model->get_top_five_applications($_id);
        $categorie = $this->Categories_model->get_categorie($_id);
        $categoryData = array(
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'widget_lasteval' => $this->load->view('inc/widget_lasteval', array(
                'applications' => $lastEvalApplis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'widget_topfive' => $this->load->view('inc/widget_topfive', array(
                'applications' => $top5Applis,
                'categorie' => $categorie,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'widget_allappcategory' => $this->load->view('inc/widget_allappcategory', array(
                'categorie' => $categorie,
            ), true),
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'widget_news' => $this->load->view('inc/widget_news', '', true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
            'categorie' => $categorie,
        );

        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/category', $categoryData, true);
        $data['body_class'] = 'category particuliers '.to_ascii($categorie->{"nom_".config_item('language_short')});
        $this->load->view('main', $data);
    }

    public function app($_id)
    {
        $this->load->model('Devices_model');
        $application = $this->_get_app_infos($_id);
        $appData = array(
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'partners' => $this->load->view('inc/partners', '', true),
            'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
            'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            'application' => $application,
        );
//var_dump($appData['application']);
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/app', $appData, true);
        $data['body_class'] = 'app particuliers '.to_ascii($application->titre);
        $this->load->view('main', $data);
    }
    
    public function mentionslegales()
	{
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/mentionslegales', '', true);
        $data['body_class'] = 'mentionslegales particuliers';
		$this->load->view('main', $data);
	}
	
	public function contact()
    {
        $data['inc'] = $this->_getCommonIncludes(false, array(
            js_url('jquery.checkValidity'),
        ));
        $data['contenu'] = $this->load->view('contenu/contact', '', true);
        $data['body_class'] = 'contact particuliers';
        $this->load->view('main', $data);
    }
   
    public function device($_id)
    {
        $this->load->model('Accessoires_model');
        $accessoire = $this->Accessoires_model->get_accessoire($_id);
        $devices_data = array(
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
            'device' => $accessoire,
        );
//        var_dump($accessoire);
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/device', $devices_data, true);
        $data['body_class'] = 'device particuliers '.to_ascii($accessoire->{"nom_".config_item('language_short')});
        $this->load->view('main', $data);
    }

    public function news($_id)
    {
//        $this->_format_all_apps_links($top5Applis);
        $devices_data = array(
            'partners' => $this->load->view('inc/partners', '', true),
        );
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/category', $devices_data, true);
        $data['body_class'] = 'category particuliers '.to_ascii('news');
        $this->load->view('main', $data);
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */