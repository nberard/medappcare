<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @property Applications_model $Applications_model
 */
class Site extends CI_Controller {

    private $correspDevises = array(
        'USD' => '$',
        'EUR' => '€',
    );

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets');
    }

	public function index()
	{
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $this->lang->load('common');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications();
        $top5Applis = $this->Applications_model->get_top_five_applications();
        //var_dump($this->Applications_model->get_selection_applications(1));
        foreach ($lastEvalApplis as &$lastEvalAppli)
            $lastEvalAppli->prix_complet = $lastEvalAppli->prix == 0.00  ? $this->lang->line('free') : $lastEvalAppli->prix.$this->correspDevises[$lastEvalAppli->devise];
        foreach ($top5Applis as &$top5Appli)
            $top5Appli->prix_complet = $top5Appli->prix == 0.00  ? $this->lang->line('free') : $top5Appli->prix.$this->correspDevises[$top5Appli->devise];

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
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'widget_news' => $this->load->view('inc/widget_news', '', true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/index', $indexData, true);
		$this->load->view('index', $data);
	}

    private function _getCommonIncludes()
    {
        return array(
            'header_meta' => $this->load->view('inc/header_meta', array('css_files' => array(css_url('stylesheet'))), true),
            'header' => $this->load->view('inc/header', '', true),
            'menuParticulier' => $this->load->view('inc/menuParticulier', '', true),
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'footer' => $this->load->view('inc/footer', '', true),
            'footer_meta' => $this->load->view('inc/footer_meta', array('js_files' => array(
                js_url('menu'),
                js_url('jquery-ui-1.10.2.custom.min'),
                js_url('jquery.placeholder.min'),
                js_url('jquery.flexslider-min'),
                js_url('bootstrap'),
//                    js_url('query-2.0.0.min'),
                js_url('scripts'),
            )), true),
        );
    }

    public function register()
    {
        $data['inc'] = $this->_getCommonIncludes();
        $data['js_files'] = array(
            'bootstrap-datepicker',
            'bootstrap-multiselect',
        );
        $data['contenu'] = $this->load->view('contenu/register', $data, true);
        $this->load->view('register', $data);
    }

    function langTest()
    {
        // load language file
        $this->lang->load('about');


        $this->load->view('about');
    }
}

/* End of file site.php */
/* Location: ./application/controllers/site.php */