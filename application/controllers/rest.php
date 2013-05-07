<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
/*
 * @property Membres_model $Membres_model
 */
class Rest extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('crypt');
        $this->lang->load('common');
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
        $countries = array_flip(config_item('country_list'));
        $list = !empty($_POST['pro']) ?
            array() :
            array('email', 'password', 'date_naissance', 'sexe', 'country', 'cgu', 'cgv');
        foreach($list as $field)
            if(!isset($_POST[$field]))
                $_POST[$field] = '';
        $_POST['country'] = isset($countries[$_POST['country']]) ? $countries[$_POST['country']] : 'FR';
        $this->load->library('form_validation');
        $this->lang->load('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[membre.email]');
        $this->form_validation->set_rules('password', 'Mot de passe', 'required|max_length[32]|min_length[4]');
        $this->form_validation->set_rules('date_naissance', 'Date de naissance', 'required|regex_match[/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/]');
        $this->form_validation->set_rules('sexe', 'Sexe', 'required|alpha_numeric|exact_length[1]|enum[F,M,A]');
        $this->form_validation->set_rules('country', 'Pays', 'required|alpha_numeric|exact_length[2]');
        $this->form_validation->set_rules('cgu', 'CGU', 'required|enum[1]');
        $this->form_validation->set_rules('cgv', 'CGV', 'required|enum[1]');
        if(!$this->form_validation->run())
        {
            $errorMessage = '';
            foreach($_POST as $key => $value)
            {
                $error = form_error($key);
                if($error)
                {
                    log_message('debug', "adding $error for $key");
                    $errorMessage.=$error;
                }
            }
            $this->response(array('status' => 'ko', 'message' => $errorMessage), 400);
        }
        else
        {
            $this->response(array('status' => 'ok'), 200);
        }
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */