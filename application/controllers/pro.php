<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/Common_Controller.php';
/*
 * @property Applications_model $Applications_model
 */
class Pro extends Common_Controller {

    public function __construct()
    {
        parent::__construct(true);
    }


    public function index()
    {
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications();
        $top5Applis = $this->Applications_model->get_top_five_applications();
        //var_dump($this->Applications_model->get_selection_applications(1));
        $this->_format_all_apps_prices($lastEvalApplis);
        $this->_format_all_apps_prices($top5Applis);
        $this->_format_all_apps_links($lastEvalApplis);
        $this->_format_all_apps_links($top5Applis);
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
        $data['body_class'] = 'homepage lespros';
        $this->load->view('main', $data);
    }

    public function register()
    {
        $data['inc'] = $this->_getCommonIncludes(true, array(
            js_url('bootstrap-datepicker'),
            js_url('bootstrap-multiselect'),
            js_url('jquery.checkValidity'),
            js_url('registerPro'),
        ));
        $data['contenu'] = $this->load->view('contenu/registerPro', '', true);
        $data['body_class'] = 'signup lespros';
        $this->load->view('main', $data);
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
        $data['body_class'] = 'category lespros masante';
        $this->load->view('main', $data);
    }

    public function app($_id)
    {
        $appData = array(
            'widget_devices' => $this->load->view('inc/widget_devices', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $appData['app'] = $this->_get_app_infos($_id);
        $data['inc'] = $this->_getCommonIncludes(true);

        $data['contenu'] = $this->load->view('contenu/app', $appData, true);
        $data['body_class'] = 'app lespros masante';
        $this->load->view('main', $data);
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */