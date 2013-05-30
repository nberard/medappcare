<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
/*
 * @property Membres_model $Membres_model
 */
class Application extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('country');
        $this->load->helper('crypt');
        $this->load->helper('country');
        $this->lang->load('alert');
//        $this->output->enable_profiler(TRUE);
    }

    public function topfiveapplis_get($_categorie_id = -1)
    {
        $_free = $this->_get('free');
        $template = $this->_get('template');
        $free = ($_free && $_free == 1);
        $links = $this->_get('links');
        $links = ($links && $links == 1);
        $this->load->model('Applications_model');
        $top5Applis = $this->Applications_model->get_top_five_applications($free, false, $_categorie_id);
        $this->_format_all_prices($top5Applis);
        $this->_format_all_notes($top5Applis);

        if($top5Applis)
        {
            if($links)
            {
                $pro = $this->_get('pro');
                $pro = ($pro && $pro == 1);
                $access_label = $pro ? 'pro' : 'perso';
                $this->_set_access_label($access_label);
                $this->_format_all_links($top5Applis, 'app');
                $this->_populate_categories_applications($top5Applis);
                $see_all_link = $this->_format_link_no_id('app_search', 1, array('free' => $_free));
            }
            if($this->response->format == "render")
            {
                $data = array(
                    'applications' => $top5Applis,
                    'free' => $free,
                    'template_render' => $template,
                    'see_all_link' => $see_all_link,
                );
                if($_categorie_id != -1)
                {
                    $this->load->model('Categories_model');
                    $data['categorie'] = $this->Categories_model->get_categorie($_categorie_id);
                }
                $this->response($this->load->view('inc/'.$template, $data, true), 200);
            }
            else
            {
                $this->response(array('status' => 'ok', 'apps' => $top5Applis), 200);
            }
        }
        else
        {
            $this->response('', 204);
        }
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */