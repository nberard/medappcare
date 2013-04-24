<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('assets');
    }

	public function index()
	{
        $indexData = array(
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'home_lasteval' => $this->load->view('inc/home_lasteval', '', true),
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