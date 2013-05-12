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
    protected $pro;
    protected $access_label;
    function __construct($_pro)
    {
        parent::__construct();
        $this->pro = $_pro;
        $this->access_label = $_pro ? 'pro' : 'perso';
        $this->config->load('price');
        $this->config->load('country');
        $this->load->helper('assets');
        $this->load->helper('link');
        $this->load->helper('price');
        $this->load->helper('date');
        $this->lang->load('common');
                $this->output->enable_profiler(TRUE);
    }

    protected function _getCommonIncludes($js_files = array())
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
        $categories_principales = $this->Categories_model->get_categories_parentes($this->pro);
        $correspClasses = $this->pro ? array('administratif', 'mapratique', 'minformer', 'mespatients') :
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
            'header' => $this->load->view('inc/header', array('pro' => $this->pro, 'access_label' => $this->access_label, 'user' => $this->session->userdata('user')), true),
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

    protected function _format_all_prices(&$_applis_array)
    {
        $this->load->helper('price');
        $this->config->load('price');
        foreach ($_applis_array as &$_appli)
            $_appli->prix_complet = format_price($_appli->prix, $_appli->devise, $this->lang->line('free'));
    }

    protected function _format_all_links(&$_data_link_array, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id')
    {
        $this->load->helper('url');
        foreach ($_data_link_array as &$_data_link)
            $_data_link->{$_link} = site_url($this->access_label.'/'.$_target.'_'.to_ascii($_data_link->{$_label_titre}).'_'.$_data_link->{$_label_id});
    }

    protected function _get_app_infos($_id)
    {
        $this->load->model('Applications_model');
        $application = $this->Applications_model->get_application($_id);
        if($application)
        {
            $application->prix_complet = format_price($application->prix, $application->devise, $this->lang->line('free'));
        }
        return $application;
    }

    protected function _get_accessoires($_nb)
    {
        $this->load->model('Accessoires_model');
        $accessoires = $this->Accessoires_model->get_last_accessoires($_nb);
        foreach($accessoires as &$accessoire)
        {
            $description_text = html_entity_decode(strip_tags($accessoire->{"description_".config_item('language_short')}));
            $accessoire->description_short = substr($description_text, 0, 80).' ...';
        }
        $this->_format_all_prices($accessoires);
        $this->_format_all_links($accessoires, 'device', "nom_".config_item('language_short'));
        return $accessoires;
    }
}