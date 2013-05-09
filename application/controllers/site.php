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
}

/* End of file perso.php */
/* Location: ./application/controllers/perso.php */