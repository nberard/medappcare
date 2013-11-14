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
            $this->load->model('Categories_model');
            $this->load->model('Devices_model');
            $membre->categories = $this->Categories_model->get_categories_id_from_membre($membre->id);
            $membre->devices = $this->Devices_model->get_devices_from_membre($membre->id);
//            log_message('debug', "membre=".var_export($membre, true));
            $response = array('status' => 'ok');
            if($session)
            {
                $this->session->set_userdata('user', $membre);
                $response['redirect'] = !empty($_SERVER['HTTP_REFERER']) && $membre->est_pro == '0' ? $_SERVER['HTTP_REFERER'] : site_url(($membre->est_pro ? 'pro' : 'gp').'/index');
            }
            $this->response($response, 200);
        }
        else
        {
            $this->response(array('status' => 'ko', 'message' => lang('erreur_login')), 400);
        }
    }

    public function signaler_post()
    {
        $app_name = $this->_post('app_name');
        $app_id = $this->_post('app_id');
        $cause = $this->_post('cause');
        $description = $this->_post('description');
            $this->load->library('email');

            $this->email->from('report@medappcare.com', 'Medappcare report');
            $this->email->to(config_item('contact_mail'));
            $this->email->subject("[Medappcare] Signalisation de l'application");
            $this->email->message("Un utilisateur a signaler l'application ".$app_name." (".$app_id.") pour cause de \"".$cause."\"<br/>
            L'utilisateur a ajouté le message suivant : ".$description);
            if($this->email->send())
            {
                $this->response(array('status' => 'ok', 'message' => 'Un e-mail a été envoyé pour signaler cette application'), 200);
            }
        else
        {
            $this->response(array('status' => 'ko', 'errors' => "Echec de l'envoie de l'e-mail"), 400);
        }
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */