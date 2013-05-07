<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Controller extends CI_Controller {

    protected $correspDevises = array(
        'USD' => '$',
        'EUR' => '€',
    );

	function __construct()
	{
		parent::__construct();
        $this->load->helper('assets');
        $this->load->helper('redirect');
        $this->lang->load('common');
//                $this->output->enable_profiler(TRUE);
	}

    protected function _getCommonIncludes($pro = false)
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
        $menu = $pro ? 'menuMedecin' : 'menuParticulier';
        $categories_principales = $this->Categories_model->get_categories_parentes($pro);
        $correspClasses = array('navadministratif megamenu', 'navmapratique megamenu', 'navminformer megamenu', 'navmespatients megamenu');
        foreach($categories_principales as &$categorie_principale)
        {
            $categorie_principale->class = array_shift($correspClasses);
            $categorie_principale->link = '#';
        }
//        <!--        <li class="navadministratif megamenu">-->
//<!--            <a href="navadministratif.php"><span class="picto"></span><span class="text">Administratif<span></a>-->
//<!--        </li>-->
//<!--        <li class="navmapratique megamenu">-->
//<!--            <a href="navmapratique.php"><span class="picto"></span><span class="text">Ma Pratique</span></a>-->
//<!--        </li>-->
//<!--        <li class="navminformer megamenu">-->
//<!--            <a href="navprominformer.php"><span class="picto"></span><span class="text">M'Informer</span></a>-->
//<!--        </li>-->
//<!--        <li class="navmespatients megamenu">-->
//<!--            <a href="navmespatients.php"><span class="picto"></span><span class="text">Mes Patients</span></a>-->
//<!--        </li>-->
        return array(
            'header_meta' => $this->load->view('inc/header_meta', array('css_files' => array(css_url('stylesheet'))), true),
            'header' => $this->load->view('inc/header', array('pro' => $pro, 'user' => $this->session->userdata('user')), true),
            'home_slider' => $this->load->view('inc/home_slider', '', true),
            $menu => $this->load->view('inc/'.$menu, array('categories_principales' => $categories_principales), true),
            'widget_selection' => $this->load->view('inc/widget_selection', '', true),
            'footer' => $this->load->view('inc/footer', array('languages' => $languagesVars), true),
            'footer_meta' => $this->load->view('inc/footer_meta', array('js_files' => array(
                js_url('menu'),
                js_url('jquery-ui-1.10.2.custom.min'),
                js_url('jquery.placeholder.min'),
                js_url('jquery.flexslider-min'),
                js_url('bootstrap'),
//                    js_url('query-2.0.0.min'),
                js_url('login'),
                js_url('scripts'),
            )), true),
        );
    }
	

}

/* End of file */
