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
            $response = array('status' => 'ok');
            if($session)
            {
                $this->session->set_userdata('user', $membre);
                $response['redirect'] = site_url(($membre->est_pro ? 'pro' : 'perso').'/index');
            }
            $this->response($response, 200);
        }
        else
        {
            $this->response(array('status' => 'ko', 'message' => lang('erreur_login')), 400);
        }
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */