<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @property Applications_model $Applications_model
 */
class Site extends CI_Controller {

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
        //var_dump($this->Applications_model->get_selection_applications(1));
        foreach ($lastEvalApplis as &$lastEvalAppli)
        {
            $lastEvalAppli->prix_complet = $lastEvalAppli->prix == 0.00  ? $this->lang->line('free') : $lastEvalAppli->prix.$this->correspDevises[$lastEvalAppli->devise];
        }
        $indexData = array(
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'home_lasteval' => $this->load->view('inc/home_lasteval', array(
                'applications' => $lastEvalApplis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'home_topfive' => $this->load->view('inc/home_topfive', '', true),
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'widget_news' => $this->load->view('inc/widget_news', '', true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
        );

        $data['header'] =  $this->load->view('inc/header', '', true);
        $data['footer_meta'] = $this->load->view('inc/footer_meta', array('js_files' => array(js_url('scripts'), js_url('jquery.flexslider-min'))), true);
        $data['css_files'] = array(css_url('stylesheet'));
        $data['contenu'] = $this->load->view('contenu/index', $indexData, true);
		$this->load->view('index', $data);
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