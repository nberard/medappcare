<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nico
 * Date: 09/05/13
 * Time: 16:06
 * To change this template use File | Settings | File Templates.
 */

class Common_Controller extends MY_Controller
{
    protected $pro;
    protected $access_label_target;
    protected $body_class;
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
//        $this->benchmark->mark('get_parents_start');
        $categories_principales = $this->Categories_model->get_categories_parentes($this->pro);
        $categories_principales_target = $this->Categories_model->get_categories_parentes(!$this->pro);
//        $this->benchmark->mark('get_parents_end');
//        $this->benchmark->mark('get_enfants_start');
        $this->_populate_categories_enfants($categories_principales_target);
        $this->_populate_categories_enfants($categories_principales);
//        $this->benchmark->mark('get_enfants_end');
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
                js_url('jquery.autoellipsis'),
                js_url('bootstrap'),
                js_url('bootstrap-multiselect'),
                js_url('jquery.bootpag.min'),
                js_url('menu'),
                js_url('login'),
                js_url('scripts'),
            ),$js_files)), true),
        );
    }

    protected function _populate_categories_enfants(&$_categories_array, $add_link = true)
    {
//        log_message('debug', "_populate_categories_enfants=".var_export($_categories_array, true));
        $_categories_ids = array();
        foreach($_categories_array as $_categorie)
        {
            $_categories_ids[] = $_categorie->id;
            $_categories_enfants[$_categorie->id] = array();
        }
//        log_message('debug', "_categories_ids=".var_export($_categories_ids, true));
        $_categories_enfants_brut = $this->Categories_model->get_categories_enfantes($_categories_ids);
        foreach($_categories_enfants_brut as $_categorie_enfant)
        {
            $_categories_enfants[$_categorie_enfant->parent_id][] = $_categorie_enfant;
        }
//        log_message('debug', "_categories_enfants=".var_export($_categories_enfants, true));
        foreach($_categories_array as &$_categorie)
        {
            $_categorie->enfants = $_categories_enfants[$_categorie->id];
            if($add_link)
            {
                $this->_format_all_links($_categorie->enfants, 'category', 'nom');
            }
        }
//        log_message('debug', "_categories_array=".var_export($_categories_array, true));
//        foreach($_categories_array as &$_categorie)
//        {
//            $_categorie->enfants = $this->Categories_model->get_categories_enfantes($_categorie->id);
//            if($add_link)
//            {
//                $this->_format_all_links($_categorie->enfants, 'category', 'nom');
//            }
//        }
    }

    protected function _get_app_infos($_id)
    {
        $this->load->model('Applications_model');
        $application = $this->Applications_model->get_application($_id);
        if($application)
        {

            $application->prix_complet = format_price($application->prix, $application->devise, $this->lang->line('free'));
            $this->_format_note($application, array('note_user', 'note_pro'));
            $this->load->model('Application_screenshots_model');
            $application->screenshots = $this->Application_screenshots_model->get_screenshots($application->id);
            $application->qr_code_url = qr_code_url($application->lien_download);
        }
        log_message('debug', "application=".var_export($application, true)."");
        return $application;
    }

    protected function _get_accessoires($_nb)
    {
        $this->load->model('Accessoires_model');
        $accessoires = $this->Accessoires_model->get_last_accessoires($_nb);
//        var_dump($accessoires);
        $this->load->helper('format_string');
        foreach($accessoires as &$accessoire)
        {
            $accessoire->description_short = short_html_text($accessoire->presse);
        }
        $this->_format_all_prices($accessoires);
        $this->_format_all_links($accessoires, 'device', "nom");
        return $accessoires;
    }

    protected function _common_index($_applis_selection_left, $_label_selection_left, $_applis_selection_right, $_label_selection_right)
    {
        $this->load->model('Devices_model');
        $this->load->model('Articles_model');
        $this->load->model('Applications_model');

        $articles = $this->Articles_model->get_last_articles(1);
        $this->load->helper('format_string');
        foreach ($articles as &$article)
        {
            $article->date_full = date_full($article->date_creation);
            $article->contenu_short = short_html_text($article->contenu);
        }
        $this->_format_all_links($articles, 'news', "titre");
        $this->_format_all_links($articles, 'news_category', 'nom_categorie', 'categorie_link', 'categorie_id');
        $indexData = array(
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            $_label_selection_left => $this->load->view('inc/'.$_label_selection_left, array(
                'applications' => $_applis_selection_left,
            ), true),
            $_label_selection_right => $this->load->view('inc/'.$_label_selection_right, array(
                'free' => false,
                'applications' => $_applis_selection_right,
                'template_render' => 'home_topfive',
            ), true),
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'widget_news' => $this->load->view('inc/widget_news', array(
                'access_label' => $this->access_label,
                'articles' => $articles
            ), true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
        );

        $data['inc'] = $this->_getCommonIncludes(array(js_url('list')));
        $template = $this->pro ? 'indexPro' : 'index';
        $data['contenu'] = $this->load->view('contenu/'.$template, $indexData, true);
        $data['body_class'] = 'homepage '.$this->body_class;
        $this->load->view('main', $data);
    }

    public function category($_id)
    {
        $this->load->model('Applications_model');
        $this->load->model('Devices_model');
        $this->load->model('Categories_model');
        $lastEvalApplis = $this->Applications_model->get_last_eval_applications($_id);
        $top5Applis = $this->Applications_model->get_top_five_applications(false, $this->pro, $_id);
        $this->_format_all_prices($lastEvalApplis);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_links($lastEvalApplis, 'app');
        $this->_format_all_links($lastEvalApplis, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');
        $this->_format_all_links($top5Applis, 'app');
        $this->_format_all_links($top5Applis, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');
        $categorie = $this->Categories_model->get_categorie($_id);
        $this->_format_link($categorie, 'app_category', 'nom', 'link_all', 'id' ,1);
        $categoryData = array(
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'widget_lasteval' => $this->load->view('inc/widget_lasteval', array(
                'applications' => $lastEvalApplis,
            ), true),
            'widget_topfive' => $this->load->view('inc/widget_topfive', array(
                'applications' => $top5Applis,
                'categorie' => $categorie,
                'free' => false,
                'template_render' => 'widget_topfive',
            ), true),
            'widget_allappcategory' => $this->load->view('inc/widget_allappcategory', array(
                'app_grid' => $this->load->view('inc/app_grid', array(
                    'categorie' => $categorie,
                ), true),
                'access_label' => $this->access_label,
            ), true),
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'home_pushpartners' => $this->load->view('inc/home_pushpartners', '', true),
            'partners' => $this->load->view('inc/partners', '', true),
            'categorie' => $categorie,
        );

        $data['inc'] = $this->_getCommonIncludes(array(js_url('list')));

        $data['contenu'] = $this->load->view('contenu/category', $categoryData, true);
        $data['body_class'] = 'category '.$this->body_class.' '.$categorie->class;
        $this->load->view('main', $data);
    }

    public function app($_id)
    {
        $this->load->model('Devices_model');
        $application = $this->_get_app_infos($_id);
        $appData = array(
            'widget_devices' => $this->load->view('inc/widget_devices', array('accessoires' => $this->_get_accessoires(6)), true),
            'partners' => $this->load->view('inc/partners', '', true),
            'application' => $application,
        );
//var_dump($appData['application']);
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/app', $appData, true);
        $data['body_class'] = 'app '.$this->body_class.(!empty($application->class) ? ' '.$application->class : '');
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
        $data['body_class'] = 'device '.$this->body_class.' '.to_ascii($accessoire->nom);
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
        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('jquery.checkValidity'),
        ));
        $data['contenu'] = $this->load->view('contenu/contact', '', true);
        $data['body_class'] = 'contact particuliers';
        $this->load->view('main', $data);
    }

    public function news($_id)
    {
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/news', '', true);
        $data['body_class'] = 'news';
        $this->load->view('main', $data);
    }

    public function list_news($_page)
    {

        $data['inc'] = $this->_getCommonIncludes();
        $this->load->model('Articles_model');
        $articles = $this->Articles_model->get_last_articles($_page);
        $this->load->helper('format_string');
        foreach ($articles as &$article)
        {
            $article->date_full = date_full($article->date_creation);
        }
        $nb_news = $this->Articles_model->get_count_news();
        $prev_link = $next_link = null;
        if($nb_news > config_item('nb_results_news_list') * $_page)
        {
            $next_link = $this->_format_link_no_id('list_news', $_page + 1);
        }
        if($_page > 1)
        {
            $prev_link = $this->_format_link_no_id('list_news', $_page - 1);
        }

        $data['contenu'] = $this->load->view('contenu/list_news', array(
            'articles' => $articles,
            'prev_link' => $prev_link,
            'next_link' => $next_link,
        ), true);
        $data['body_class'] = 'news';
        $this->load->view('main', $data);
    }

    public function cgu()
    {
        $data['inc'] = $this->_getCommonIncludes();

        $data['contenu'] = $this->load->view('contenu/cgu', '', true);
        $data['body_class'] = 'cgu particuliers';
        $this->load->view('main', $data);
    }

    public function app_category($_categorie_id, $_page)
    {
        $offset = $_page-1;
        $this->load->model('Categories_model');
        $this->load->model('Applications_model');
        $search_params = $this->_get_all_search_params($_GET);
        log_message('debug', "search_params=".var_export($search_params, true));

        $categorie = $this->Categories_model->get_categorie($_categorie_id);
        $applications = $this->Applications_model->get_applications_from_categorie($this->pro, $search_params['devices'], $_categorie_id, $search_params['free'], $search_params['sort'], $search_params['order'], $offset * config_item('nb_results_list'));
        $this->_format_all_prices($applications);
        $this->_format_all_notes($applications);
        $this->_format_all_links($applications, 'app');
        $this->_populate_categories_applications($applications);

        if(count($applications) == config_item('nb_results_list'))
        {
            $this->_format_link($categorie, 'app_category', 'nom', 'link_all_next', 'id' ,$_page+1, $search_params);
        }
        if($_page > 1)
        {
            $this->_format_link($categorie, 'app_category', 'nom', 'link_all_prev', 'id' ,$_page-1, $search_params);
        }
        $this->load->model('Devices_model');
        $devices = $this->Devices_model->get_all_devices();

        $data['inc'] = $this->_getCommonIncludes(array(
            js_url('bootstrap-multiselect'),
            js_url('search'),
        ));

        $data['contenu'] = $this->load->view('contenu/list_app', array(
            'app_grid' => $this->load->view('inc/app_grid', array(
                'applications' => $applications,
            ), true),
            'prev_link' => isset($categorie->link_all_prev) ? $categorie->link_all_prev : null,
            'next_link' => isset($categorie->link_all_next) ? $categorie->link_all_next : null,
            'titre' => 'Toutes les applications dans '.$categorie->nom,
            'devices' => $devices,
            'search_params' => $search_params,
        ), true);
        $data['body_class'] = 'category '.$this->body_class.' '.$categorie->class;
        $this->load->view('main', $data);
    }

    public function app_search($_page)
    {
        $offset = $_page-1;
        $this->load->model('Applications_model');
        $search_params = $this->_get_all_search_params($_GET);
        $term = request_get_param($_GET, 'term', null);
        $search_params['term'] = $term;
        $applications = $this->Applications_model->get_applications_from_keyword($this->pro, $search_params['devices'], $term, $search_params['free'], $search_params['sort'], $search_params['order'], $offset * config_item('nb_results_list'));
        $this->_format_all_prices($applications);
        $this->_format_all_notes($applications);
        $this->_format_all_links($applications, 'app');
        $this->_populate_categories_applications($applications);
        $next_link = count($applications) == config_item('nb_results_list') ?
            $this->_format_link_no_id('app_search', $_page+1, $search_params) :
            null;
        $prev_link = $_page > 1 ? $this->_format_link_no_id('app_search', $_page-1, $search_params) :
            null;

        $this->load->model('Devices_model');
        $devices = $this->Devices_model->get_all_devices();

        $data['inc'] = $this->_getCommonIncludes(array(
         //   js_url('bootstrap-multiselect'),
            js_url('search'),
        ));

        $data['contenu'] = $this->load->view('contenu/list_app', array(
            'app_grid' => $this->load->view('inc/app_grid', array(
                'applications' => $applications,
            ), true),
            'prev_link' => $prev_link,
            'next_link' => $next_link,
            'titre' => 'Toutes les applications correspondant à "'.$term.'"',
            'devices' => $devices,
            'search_params' => $search_params,
        ), true);
        $data['body_class'] = 'category '.$this->body_class;
        $this->load->view('main', $data);
    }

    protected function _get_all_search_params($_params)
    {
        $this->load->model('Devices_model');
        $device_objs = $this->Devices_model->get_all_devices();
        foreach($device_objs as $device_obj)
        {
            $devices_ids_bd[] = $device_obj->id;
        }
        $this->load->helper('format_string');
        $sort = request_get_param($_params, 'sort', 'date_ajout', array('date_ajout', 'prix'));
        $order = request_get_param($_params, 'order', 'desc', array('asc', 'desc'));
        $free = request_get_param($_params, 'free', -1, array(0, 1));
        $free = ($free == -1 ? -1 : ($free == 1 ? true : false));

        $devices = request_get_param($_params, 'devices', -1);
        if($devices != -1)
        {
            $tab_devices = explode(',', $devices);
            if(is_array($tab_devices))
            {
                foreach($tab_devices as $device_id)
                {
                    if(in_array($device_id, $devices_ids_bd))
                    {
                        if(is_string($devices))
                        {
                            $devices = array();
                        }
                        $devices[] = $device_id;
                    }
                }
            }
        }

        return array(
            'sort' => $sort,
            'order' => $order,
            'free' => $free,
            'devices' => $devices,
        );
    }
}