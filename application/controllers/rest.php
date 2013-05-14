<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
/*
 * @property Membres_model $Membres_model
 */
class Rest extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('country');
        $this->load->helper('crypt');
        $this->load->helper('country');
        $this->lang->load('alert');
//        $this->output->enable_profiler(TRUE);
    }

    public function connect_post()
    {
        $this->load->model('Membres_model');
        $email = $this->_post('email');
//        var_dump(file_get_contents('php://input'));
        $password = $this->_post('password');
        $session = $this->_post('session');
        $membre = $this->Membres_model->exists_membres(array('email' => $email, 'mot_de_passe' => get_crypt_password($password)));
        if($membre)
        {
            if($session)
            {
                $this->session->set_userdata('user', $membre);
            }
            $this->response(array('status' => 'ok'), 200);
        }
        else
        {
            $this->response(array('status' => 'ko', 'message' => lang('erreur_login')), 400);
        }
    }

    public function signup_post()
    {
        $_POST = $this->_post();

        $pro = !empty($_POST['pro']);
        $list = $pro ?
            array('email', 'mot_de_passe', 'nom', 'prenom', 'cgu_valid', 'profession', 'numero_rpps') :
            array('email', 'mot_de_passe', 'date_naissance', 'sexe', 'pays', 'cgu_valid', 'cgv_valid');
        foreach($list as $field)
            if(!isset($_POST[$field]))
                $_POST[$field] = '';
        if(!$pro)
        {
            $countries = array_flip(config_item('country_list'));
            $_POST['pays'] = isset($countries[$_POST['pays']]) ? $countries[$_POST['pays']] : 'FR';
        }
        $this->load->library('form_validation');
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[membre.email]');
        $this->form_validation->set_rules('mot_de_passe', 'Mot de passe', 'required|max_length[32]|min_length[4]');
        $this->form_validation->set_rules('cgu_valid', 'CGU', 'required|enum[1]');
        if($pro)
        {
            $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[256]');
            $this->form_validation->set_rules('prenom', 'Prénom', 'required|max_length[256]');
            $this->form_validation->set_rules('profession', 'Profession', 'required|max_length[256]');
            $this->form_validation->set_rules('numero_rpps', 'Numéro RPPS', 'max_length[128]');
        }
        else
        {
            $this->form_validation->set_rules('date_naissance', 'Date de naissance', 'required|regex_match[/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/]');
            $this->form_validation->set_rules('sexe', 'Sexe', 'required|alpha_numeric|exact_length[1]|enum[H,F,A]');
            $this->form_validation->set_rules('pays', 'Pays', 'required|alpha_numeric|exact_length[2]');
            $this->form_validation->set_rules('cgv_valid', 'CGV', 'required|enum[1]');
        }
        log_message('debug', "run for=".var_export($_POST, true)."");
        if(!$this->form_validation->run())
        {
            $errors = array();
            foreach($_POST as $key => $value)
            {
                $error = form_error($key);
                if($error)
                {
                    log_message('debug', "adding $error for $key");
                    $errors[] = $error;
                }
            }
            $this->response(array('status' => 'ko', 'errors' => $errors), 400);
        }
        else
        {
            log_message('debug', "post=".var_export($_POST, true)."");
//            $this->form_validation->
//            log_message('debug', "post2=".var_export($_POST, true)."");

            $this->load->model('Membres_model');
            $membre_id = $this->Membres_model->insert_membres($_POST, $list);
            if($membre_id && ($membre = $this->Membres_model->exists_membres(array('id' => $membre_id))))
            {
                $this->session->set_userdata('user', $membre);
                $this->response(array('status' => 'ok', 'message' => lang('ok_reg'), 'redirect' => site_url(($pro ? 'pro' : 'perso').'/index')), 200);
                return;
            }
            else
            {
                log_message('error', "la création d'un membre a échoué : ".var_export($_POST, true));
                $this->response(array('status' => 'ko', 'errors' => lang('ko_reg_server')), 500);
            }
        }
    }

    public function topfiveapplis_get()
    {
        $free = $this->_get('free');
        $free = ($free && $free == 1);
        $links = $this->_get('links');
        $links = ($links && $links == 1);
        $this->load->model('Applications_model');
        $top5Applis = $this->Applications_model->get_top_five_applications($free);
        $this->_format_all_prices($top5Applis);
        if($links)
        {
            $pro = $this->_get('pro');
            $pro = ($pro && $pro == 1);
            $access_label = $pro ? 'pro' : 'perso';
            $this->_set_access_label($access_label);
            $this->_format_all_links($top5Applis, 'app');
            $this->_format_all_links($top5Applis, 'category', 'nom_categorie', 'link_categorie', 'categorie_id');
        }
        if($top5Applis)
        {
            log_message('debug', "format=".var_export($this->response->format, true));
            if($this->response->format == "render")
            {
                $this->load->model('Devices_model');
                $this->response($this->load->view('inc/home_topfive', array(
                    'applications' => $top5Applis,
                    'deviceAndroid' => Devices_model::APPLICATION_DEVICE_ANDROID,
                    'deviceApple' => Devices_model::APPLICATION_DEVICE_APPLE,
                    'free' => $free,
                ), true), 200);
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