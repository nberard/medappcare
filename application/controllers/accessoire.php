<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'libraries/REST_Controller.php';
/*
 * @property Membres_model $Membres_model
 */
class Accessoire extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index_post($_accessoire_id, $_action, $_user_id)
    {
        log_message('debug', "Accessoire index_put($_accessoire_id, $_action, $_user_id)");
        if($_action == 'note')
        {
            $list = array('commentaire');
            $this->load->model('Accessoires_model');
            $criteres = $this->Accessoires_model->get_criteres_for_accessoires();
            foreach($criteres as $critere)
            {
                $list[] = 'note'.$critere->id;
            }
            $_POST = $this->_post();
            foreach($list as $field)
                if(!isset($_POST[$field]))
                    $_POST[$field] = '';

            $this->load->library('form_validation');
            $this->lang->load('form_validation');
            foreach($criteres as $critere)
            {
                $notes[$critere->id] = $_POST['note'.$critere->id];
                $this->form_validation->set_rules('note'.$critere->id, 'Note '.$critere->nom, 'required|is_natural|less_than['.(config_item('note_max_accessoire') + 1).']');
            }
            $this->form_validation->set_rules('commentaire', 'Commentaire', 'required|max_length[512]');
            if(!$this->form_validation->run())
            {
                $errors = $this->_validation_get_errors();
                $this->response(array('status' => 'ko', 'errors' => $errors), 400);
            }
            else
            {
                if(!$this->Accessoires_model->user_has_note_accessoire($_accessoire_id, $_user_id))
                {
                    if($this->Accessoires_model->add_notes_to_accessoire($_accessoire_id, $_user_id, $notes, urldecode($_POST['commentaire'])))
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
                    $this->response(array('status' => 'ko', 'errors' => array('Vous avez déjà noté cet accessoire')), 400);
                }
            }
        }
    }

    public function index_get($_accessoire_id, $_data, $_page)
    {
        if($_data == 'notes')
        {
            if(is_numeric($_accessoire_id) && is_numeric($_page))
            {
                $this->load->model('Accessoires_model');
                $criteres = $this->Accessoires_model->get_criteres_for_accessoires();
                $notes = $this->Accessoires_model->get_notes_from_accessoire($_accessoire_id,
                                        count($criteres) * config_item('nb_comments_page'),
                                        ($_page-1) * count($criteres) * config_item('nb_comments_page'));
                $number_notes = $this->Accessoires_model->get_number_notes_from_accessoire($_accessoire_id);
                $this->_format_all_dates($notes, 'date', 'datetime');
                $prev_link = $_page != 1 ? $_page-1 : null;
                $next_link = $number_notes > config_item('nb_comments_page') * $_page ? $_page+1 : null;

                if($this->response->format == "render")
                {

                    $data = array(
                        'notes' => $notes,
                        'device_id' => $_accessoire_id,
                        'prev_link' => $prev_link,
                        'next_link' => $next_link,
                    );
                    $this->response($this->load->view('inc/widget_devicecomments', $data, true), 200);
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