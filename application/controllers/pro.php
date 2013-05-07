<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @property Applications_model $Applications_model
 */
class Pro extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
    }


    public function index()
    {
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
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
            'pro_pourlespros' => $this->load->view('inc/pro_pourlespros', array(
                'applications' => $lastEvalApplis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'pro_pourlesgens' => $this->load->view('inc/pro_pourlesgens', array(
                'applications' => $top5Applis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'widget_news' => $this->load->view('inc/widget_news', '', true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes(true);
        $data['contenu'] = $this->load->view('contenu/indexPro', $indexData, true);
        $this->load->view('indexPro', $data);
    }

    public function register()
    {
        $data['inc'] = $this->_getCommonIncludes(true);
        $data['js_files'] = array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
        );
        $data['contenu'] = $this->load->view('contenu/registerPro', $data, true);
        $this->load->view('registerPro', $data);
    }

    public function category()
    {
        $categoryData = array(
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'widget_lasteval' => $this->load->view('inc/widget_lasteval', '', true),
            'widget_topfive' => $this->load->view('inc/widget_topfive', '', true),
            'widget_allappcategory' => $this->load->view('inc/widget_allappcategory', '', true),
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'widget_news' => $this->load->view('inc/widget_news', '', true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes(true);

        $data['contenu'] = $this->load->view('contenu/category', $categoryData, true);
        $this->load->view('categoryPro', $data);
    }

    public function app()
    {
        $appData = array(
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes(true);

        $data['contenu'] = $this->load->view('contenu/app', $appData, true);
        $this->load->view('appPro', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */