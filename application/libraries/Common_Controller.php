<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nico
 * Date: 09/05/13
 * Time: 16:06
 * To change this template use File | Settings | File Templates.
 */

class Common_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->config->load('price');
        $this->config->load('country');
        $this->load->helper('assets');
        $this->load->helper('redirect');
        $this->load->helper('price');
        $this->lang->load('common');
//                $this->output->enable_profiler(TRUE);
    }

    protected function _getCommonIncludes($pro = false, $js_files = array())
    {
        $languagesVars = $this->lang->languages;
        $this->load->model('Categories_model');
        foreach ($languagesVars as $shortLanguage => &$longLanguage)
        {
            $longLanguage = array(
                'long' => $longLanguage,
                'wording' => lang($longLanguage),
                'redirect' => redirect_language($this->uri->segment_array(), $shortLanguage),
            );
        }
        $categories_enfants = array();
        $categories_principales = $this->Categories_model->get_categories_parentes($pro);
        $correspClasses = $pro ? array('administratif', 'mapratique', 'minformer', 'mespatients') :
            array('masante', 'monquotidien', 'minformer', 'medeplacer');
        foreach($categories_principales as &$categorie_principale)
        {
            $class = array_shift($correspClasses);
            $categorie_principale->class = $class;
            $categories_enfants[$class] = $this->Categories_model->get_categories_enfantes($categorie_principale->id);
            $categorie_principale->link = '#';
        }
        return array(
            'header_meta' => $this->load->view('inc/header_meta', array('css_files' => array(css_url('stylesheet'))), true),
            'header' => $this->load->view('inc/header', array('pro' => $pro, 'user' => $this->session->userdata('user')), true),
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'menu' => $this->load->view('inc/menu', array(
                'categories_principales' => $categories_principales,
                'categories_enfants_assoc' => $categories_enfants,
            ), true),
            'data_categories_principales' => $categories_principales,
            'data_categories_enfants_assoc' => $categories_enfants,
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'footer' => $this->load->view('inc/footer', array('languages' => $languagesVars), true),
            'footer_meta' => $this->load->view('inc/footer_meta', array('js_files' => array_merge(array(
                js_url('jquery-2.0.0.min'),
                js_url('jquery-ui-1.10.2.custom.min'),
                js_url('jquery.placeholder.min'),
                js_url('jquery.flexslider-min'),
                js_url('bootstrap'),
                js_url('menu'),
                js_url('login'),
                js_url('scripts'),
            ),$js_files)), true),
        );
    }
}