<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @property Membres_model $Membres_model
 */
class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
    }


    public function connect()
    {
        //test
        $this->load->model('Membres_model');
        $email = $_POST['email'];
        $password = $_POST['password'];
        $membre = $this->Membres_model->exists_membres(array('email' => $email, 'mot_de_passe' => $password));
        if($membre)
        {
            $this->session->set_userdata('user', $membre);
            $this->session->set_flashdata('success', 'vous êtes loggé');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
        else
        {
            $this->session->set_flashdata('error', 'email ou mot de passe invalide');
            redirect($_SERVER['HTTP_REFERER'], 'refresh');
        }
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */