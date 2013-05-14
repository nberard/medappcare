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
        $this->access_label_target = $_pro ? 'perso' : 'pro';
        $this->body_class = $_pro ? 'lespros' : 'particuliers';
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
        $categories_principales = $this->Categories_model->get_categories_parentes($this->pro);
        $categories_principales_target = $this->Categories_model->get_categories_parentes(!$this->pro);

        $this->_populate_categories_enfants($categories_principales_target);
        $this->_populate_categories_enfants($categories_principales);
        return array(
            'header_meta' => $this->load->view('inc/header_meta', array('css_files' => array(css_url('stylesheet'))), true),
            'header' => $this->load->view('inc/header', array(
                'pro' => $this->pro,
                'access_label' => $this->access_label,
                'access_label_target' => $this->access_label_target,
                'user' => $this->session->userdata('user'),
            ), true),
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'menu' => $this->load->view('inc/menu', array(
                'categories_principales' => $categories_principales,
            ), true),
            'data_categories_principales' => $categories_principales,
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'footer' => $this->load->view('inc/footer', array(
                'languages' => $languagesVars,
                'access_label' => $this->access_label,
                'categories_principales_pro' => $this->pro ? $categories_principales : $categories_principales_target,
                'categories_principales_perso' => $this->pro ? $categories_principales_target : $categories_principales,
            ), true),
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

    protected function _populate_categories_enfants(&$_categories_array, $add_link = true)
    {
        foreach($_categories_array as &$_categorie)
        {
            $_categorie->enfants = $this->Categories_model->get_categories_enfantes($_categorie->id);
            if($add_link)
            {
                $this->_format_all_links($_categorie->enfants, 'category', 'nom_'.config_item('lng'));
            }
        }
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
//        var_dump($accessoires);
        foreach($accessoires as &$accessoire)
        {
            $description_text = html_entity_decode(strip_tags($accessoire->{"presse_".config_item('lng')}));
            $accessoire->description_short = substr($description_text, 0, 80).' ...';
        }
        $this->_format_all_prices($accessoires);
        $this->_format_all_links($accessoires, 'device', "nom_".config_item('lng'));
        return $accessoires;
    }

    protected function _common_index()
    {
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $this->load->model('Articles_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications();
        $top5Applis = $this->Applications_model->get_top_five_applications();
        //var_dump($this->Applications_model->get_selection_applications(1));
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_format_all_links($top5Applis, 'app');

        $articles = $this->Articles_model->get_last_articles(2);
        foreach ($articles as $article)
        {
            $article->date_full = date_full($article->date_creation);
        }
        $this->_format_all_links($articles, 'news', "titre_".config_item('lng'));
        $this->_format_all_links($articles, 'category', 'nom_categorie', 'categorie_link', 'categorie_id');

        $selectionLabel1 = $this->pro ? 'pro_pourlespros' : 'home_lasteval';
        $selectionLabel2 = $this->pro ? 'pro_pourlesgens' : 'home_topfive';
        $indexData = array(
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            $selectionLabel1 => $this->load->view('inc/'.$selectionLabel1, array(
                'applications' => $lastEvalApplis,
                'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
            ), true),
            $selectionLabel2 => $this->load->view('inc/'.$selectionLabel2, array(
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
        $template = $this->pro ? 'indexPro' : 'index';
        $data['contenu'] = $this->load->view('contenu/'.$template, $indexData, true);
        $data['body_class'] = 'homepage '.$this->body_class;
        $this->load->view('main', $data);
    }

    protected function _common_category($_id)
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
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
            'categorie' => $categorie,
        );

        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/category', $categoryData, true);
        $data['body_class'] = 'category '.$this->body_class.' '.$categorie->class;
        $this->load->view('main', $data);
    }

    protected function _common_app($_id)
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
        $data['body_class'] = 'app '.$this->body_class.(!empty($application->class) ? ' '.$application->class : '');
        $this->load->view('main', $data);
    }

    protected function _common_device($_id)
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
        $data['body_class'] = 'device '.$this->body_class.' '.to_ascii($accessoire->{"nom_".config_item('lng')});
        $this->load->view('main', $data);
    }

    protected function _common_mentionslegales()
    {
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/mentionslegales', '', true);
        $data['body_class'] = 'mentionslegales particuliers';
        $this->load->view('main', $data);
    }

    protected function _common_contact()
    {
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('jquery.checkValidity'),
        ));
        $data['contenu'] = $this->load->view('contenu/contact', '', true);
        $data['body_class'] = 'contact particuliers';
        $this->load->view('main', $data);
    }

    protected function _common_news($_id)
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