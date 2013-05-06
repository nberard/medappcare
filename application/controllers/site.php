<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * @property Membres_model $Membres_model
 */
class Site extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('crypt');
        $this->lang->load('common');
//        $this->output->enable_profiler(TRUE);
    }

    public function deconnect()
    {
        $this->session->unset_userdata('user');
        $this->session->set_flashdata('success', lang('ok_logout'));
        redirect($_SERVER['HTTP_REFERER'], 'refresh');
    }

    public function connect()
    {
        $request = file_get_contents("php://input");
        if($request)
        {
            $data = json_decode($request, true);
            if($data)
            {
                $this->load->model('Membres_model');
                $email = $data['email'];
                $password = $data['password'];
                $membre = $this->Membres_model->exists_membres(array('email' => $email, 'mot_de_passe' => get_crypt_password($password)));
                if($membre)
                {
                    $this->session->set_userdata('user', $membre);
                    echo json_encode(array('status' => 'ok'));
                    return;
                }
            }
        }
        echo json_encode(array('status' => 'ko', 'message' => lang('erreur_login')));
    }
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */