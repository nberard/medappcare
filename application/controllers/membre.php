<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
/*
 * @property Membres_model $Membres_model
 */
class Membre extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->config->load('country');
        $this->load->helper('crypt');
        $this->load->helper('country');
        $this->lang->load('alert');
//        $this->output->enable_profiler(TRUE);
    }

    protected function _membre_clean_entries($_action, $_pro)
    {
        if($_action == 'create')
        {
            $list = $_pro ?
                array('email', 'pseudo', 'mot_de_passe', 'nom', 'prenom', 'cgu_valid', 'profession', 'numero_rpps') :
                array('email', 'pseudo', 'mot_de_passe', 'date_naissance', 'sexe', 'pays', 'cgu_valid', 'cgv_valid');
        }
        else
        {
            $list = $_pro ?
                array('email', 'pseudo', 'mot_de_passe', 'nom', 'prenom', 'profession') :
                array('email', 'pseudo', 'mot_de_passe', 'date_naissance', 'sexe', 'pays');
        }
        foreach($list as $field)
            if(!isset($_POST[$field]))
                $_POST[$field] = '';
        if(!$_pro)
        {
            $countries = array_flip(config_item('country_list'));
            $_POST['pays'] = isset($countries[$_POST['pays']]) ? $countries[$_POST['pays']] : 'FR';
        }
        return $list;
    }

    protected function _membre_set_rules($_list, $_action)
    {
        log_message('debug', "_membre_set_rules for=".var_export($_POST, true)." with list=".var_export($_list, true)."");
        $this->load->library('form_validation');
        $this->lang->load('form_validation');
        foreach($_list as $field)
        {
            switch($field)
            {
                case 'email':
                    if($_action == 'create')
                    {
                        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[membre.email]');
                    }
                    else
                    {
                        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
                    }
                    break;
                case 'mot_de_passe':
                    if($_action == 'create')
                    {
                        $this->form_validation->set_rules('mot_de_passe', 'Mot de passe', 'required|max_length[32]|min_length[4]');
                    }
                    else
                    {
                        $this->form_validation->set_rules('mot_de_passe', 'Mot de passe', 'max_length[32]|min_length[4]');
                    }
                    break;
                case 'nom':
                    $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[256]');
                    break;
                case 'prenom':
                    $this->form_validation->set_rules('prenom', 'Prénom', 'required|max_length[256]');
                    break;
                case 'pseudo':
                    if($_action == 'create')
                    {
                        $this->form_validation->set_rules('pseudo', 'Pseudo', 'required|max_length[64]|alpha_numeric');
                    }
                    break;
                case 'cgu_valid':
                    $this->form_validation->set_rules('cgu_valid', 'CGU', 'required|enum[1]');
                    break;
                case 'profession':
                    $this->form_validation->set_rules('profession', 'Profession', 'required|max_length[256]');
                    break;
                case 'numero_rpps':
                    $this->form_validation->set_rules('numero_rpps', 'Numéro RPPS', 'max_length[128]');
                    break;
                case 'date_naissance':
                    $this->form_validation->set_rules('date_naissance', 'Date de naissance', 'required|regex_match[/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/]');
                    break;
                case 'sexe':
                    $this->form_validation->set_rules('sexe', 'Sexe', 'required|alpha_numeric|exact_length[1]|enum[H,F,A]');
                    break;
                case 'pays':
                    $this->form_validation->set_rules('pays', 'Pays', 'required|alpha_numeric|exact_length[2]');
                    break;
                case 'cgv_valid':
                    $this->form_validation->set_rules('cgv_valid', 'CGV', 'required|enum[1]');
                    break;
            }
        }
    }

    public function index_put($_id)
    {
        $_POST = $this->_put();
        $pro = !empty($_POST['pro']);
        $list = $this->_membre_clean_entries('update', $pro);

        $this->_membre_set_rules($list, 'update');

        if(!$this->form_validation->run())
        {
            $errors = $this->_validation_get_errors();
            $this->response(array('status' => 'ko', 'errors' => $errors), 400);
        }
        else
        {
            $this->load->model('Membres_model');
            if($this->Membres_model->update_membre($_id, $_POST, $list, $pro) && $membre = $this->Membres_model->exists_membres(array('id' => $_id)))
            {
                $this->session->set_userdata('user', $membre);
                $this->response(array('status' => 'ok', 'message' => lang('ok_membre_update')), 200);
                return;
            }
            else
            {
                log_message('error', "l'update d'un membre a échoué : ".var_export($_POST, true));
                $this->response(array('status' => 'ko', 'errors' => lang('ko_membre_update')), 500);
            }
        }
    }

    public function password_put()
    {
        $_email = $this->_put('email');
        log_message('debug', " password_post($_email)");
        $new_password = uniqid();
        $this->load->model('Membres_model');
        $this->load->helper('crypt');
        $new_password_crypt = get_crypt_password($new_password);
        if($res = $this->Membres_model->update_password($_email, $new_password_crypt))
        {
            log_message('debug', "res=".var_export($res, true)."");
            $this->load->library('email');

            $this->email->from('admin@medappcare.fr', 'Medappcare admin');
            $this->email->to($_email);
            $this->email->subject('[Medappcare] Votre nouveau mot de passe');
            $this->email->message('Voice votre nouveau mot de passe : '.$new_password);
            $ok = $this->email->send();
            $this->response(array('status' => 'ok', 'message' => lang('ok_membre_update')), 200);
        }
        else
        {
            $this->response(array('status' => 'ko', 'errors' => lang('ko_membre_update')), 500);
        }
    }

    public function index_post()
    {
        $_POST = $this->_post();

        $pro = !empty($_POST['pro']);
        $list = $this->_membre_clean_entries('create', $pro);

        $this->_membre_set_rules($list, 'create');

        if(!$this->form_validation->run())
        {
            $errors = $this->_validation_get_errors();
            $this->response(array('status' => 'ko', 'errors' => $errors), 400);
        }
        else
        {
            log_message('debug', "post=".var_export($_POST, true)."");
            $this->load->model('Membres_model');
            $membre_id = $this->Membres_model->insert_membres($_POST, $list);
            if($membre_id && ($membre = $this->Membres_model->exists_membres(array('id' => $membre_id))))
            {
                $this->session->set_userdata('user', $membre);
                $this->response(array('status' => 'ok', 'message' => lang('ok_reg'), 'redirect' => site_url(($pro ? 'pro' : 'gp').'/index')), 200);
                return;
            }
            else
            {
                log_message('error', "la création d'un membre a échoué : ".var_export($_POST, true));
                $this->response(array('status' => 'ko', 'errors' => lang('ko_reg_server')), 500);
            }
        }
    }

}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */