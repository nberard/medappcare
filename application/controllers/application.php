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
        $this->load->model('Applications_model');
//        $this->output->enable_profiler(TRUE);
    }

    private function _get_bloc_applis($_param_name, $_param_boolean, $_applis, $_categorie_id)
    {
        $params[$_param_name] = $this->_get($_param_name);
        $template = $this->_get('template');
        if($_param_boolean)
        {
            $params[$_param_name] = ($params[$_param_name] && $params[$_param_name] == 1);
        }

        $links = $this->_get('links');
        $links = ($links && $links == 1);
        $top5Applis = $_applis;
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
                $search_settings = array('eval_medapp' => 1);
                $search_settings[$_param_name] = $params[$_param_name];
                $see_all_link = $this->_format_link_no_id('app_search', 1, $search_settings);
            }
            if($this->response->format == "render")
            {
                $data = array(
                    'applications' => $top5Applis,
                    'template_render' => $template,
                    'see_all_link' => $see_all_link,
                );
                $data[$_param_name] = $params[$_param_name];
                if($_categorie_id != -1)
                {
                    $this->load->model('Categories_model');
                    $data['categorie'] = $this->Categories_model->get_categorie($_categorie_id);
                }
                if($template == 'widget_allappcategory')
                {
                    $data['app_grid'] = $this->load->view('inc/app_grid', array(
                            'applications' => $top5Applis,
                            'template_render' => $template,
                        ), true);
                    unset($search_settings['eval_medapp']);
                    $this->_format_link($data['categorie'], 'app_category', 'nom', 'link_all', 'id' ,1, $search_settings);
                    $data['see_all_link'] = $data['categorie']->link_all;
                }
                log_message('debug', "data=".var_export($data, true)."");
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

    public function topfiveapplis_get($_categorie_id = -1)
    {
        $_free = $this->_get('free');
        $free = ($_free && $_free == 1);
        $this->_get_bloc_applis('free', true, $this->Applications_model->get_top_five_applications($free, false, $_categorie_id), $_categorie_id);
    }

    public function pourlesprosapplis_get($_categorie_id = -1)
    {
        $_sort = $this->_get('sort');
        $this->_get_bloc_applis('sort', false, $this->Applications_model->get_pour_les_pros_applications($_sort, $_categorie_id), $_categorie_id);
    }

    public function pourlesgensapplis_get($_categorie_id = -1)
    {
        $_sort = $this->_get('sort');
        $this->_get_bloc_applis('sort', false, $this->Applications_model->get_pour_les_gens_applications($_sort, $_categorie_id), $_categorie_id);
    }

    public function allappcategory_get($_categorie_id = -1)
    {
        $_free = $this->_get('free');
        $free = ($_free && $_free == 1);
        $allappcategory = $this->Applications_model->get_applications_from_categorie(null, -1, $_categorie_id, $free, 'date', 'desc', 1);
        $this->_get_bloc_applis('free', true, $allappcategory, $_categorie_id);
    }

    public function index_post($_application_id, $_action, $_user_id)
    {
        log_message('debug', "Application index_post($_application_id, $_action, $_user_id)");
        if($_action == 'note')
        {
            $list = array('commentaire', 'pro');
            $_POST = $this->_post();
            $pro = !empty($_POST['pro']) && $_POST['pro'] == 1;
            $criteres = $this->Applications_model->get_criteres_for_applications($pro);
            foreach($criteres as $critere)
            {
                $list[] = 'note'.$critere->id;
            }
            foreach($list as $field)
                if(!isset($_POST[$field]))
                    $_POST[$field] = '';

            $this->load->library('form_validation');
            $this->lang->load('form_validation');
            foreach($criteres as $critere)
            {
                $notes[$critere->id] = $_POST['note'.$critere->id];
                $this->form_validation->set_rules('note'.$critere->id, 'Note '.$critere->nom, 'required|is_natural|less_than['.(config_item('note_max_user') + 1).']');
            }
            $this->form_validation->set_rules('commentaire', 'Commentaire', 'required|max_length[512]');
            if(!$this->form_validation->run())
            {
                $errors = $this->_validation_get_errors();
                $this->response(array('status' => 'ko', 'errors' => $errors), 400);
            }
            else
            {
                if(!$this->Applications_model->user_has_note_application($pro, $_application_id, $_user_id))
                {
                    if($this->Applications_model->add_notes_to_application($pro, $_application_id, $_user_id, $notes, urldecode($_POST['commentaire'])))
                    {
                        $this->response(array('status' => 'ok', 'message' => 'Votre note a bien été prise en compte.', 200));
                    }
                    else
                    {
                        $this->response(array('status' => 'ko', 'errors' => array("Impossible d'ajouter votre note, veuillez réessayer plus tard.")), 500);
                    }
                }
                else
                {
                    $this->response(array('status' => 'ko', 'errors' => array('Vous avez déjà noté ce produit')), 400);
                }
            }
        }
    }

    public function index_get($_application_id, $_data, $_page)
    {
        if($_data == 'notes')
        {
            if(is_numeric($_application_id) && is_numeric($_page))
            {
                $pro = $this->_get('pro');
                $pro = ($pro && $pro == 1);
                $criteres = $this->Applications_model->get_criteres_for_applications($pro);
                $notes = $this->Applications_model->get_notes_from_application($pro, $_application_id,
                    count($criteres) * config_item('nb_comments_page'),
                    ($_page-1) * count($criteres) * config_item('nb_comments_page'));
                $number_notes = $this->Applications_model->get_number_notes_from_application($pro, $_application_id);
//                $this->_format_all_dates($notes, 'date', 'datetime');
                $prev_link = $_page != 1 ? $_page-1 : null;
                $next_link = $number_notes > config_item('nb_comments_page') * $_page ? $_page+1 : null;

                if($this->response->format == "render")
                {

                    $data = array(
                        'notes' => $notes,
                        'application_id' => $_application_id,
                        'prev_link' => $prev_link,
                        'next_link' => $next_link,
                        'pro' => $pro
                    );
                    $this->response($this->load->view('inc/widget_appcomments', $data, true), 200);
                }
                else
                {
                    $this->response(array('status' => 'ok', 'notes' => $notes), 200);
                }
            }
            else
            {
                $this->response(array('status' => 'ko', 'errors' => array('Paramètres invalides')), 400);
            }
        }
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */