<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// CodeIgniter i18n library by Jérôme Jaglale
// http://maestric.com/en/doc/php/codeigniter_i18n
// version 10 - May 10, 2012

class MY_Controller extends CI_Controller {

    protected $access_label;

    public function __construct()
    {
        parent::__construct();
    }

    public function _set_access_label($_access_label)
    {
        $this->access_label = $_access_label;
    }

    protected function _format_all_prices(&$_applis_array)
    {
        $this->load->helper('price');
        $this->config->load('price');
        $this->lang->load('common');
        foreach ($_applis_array as &$_appli)
            $_appli->prix_complet = format_price($_appli->prix, $_appli->devise, $this->lang->line('free'));
    }

    protected function _format_all_links(&$_data_link_array, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id')
    {
        $this->load->helper('url');
        $this->load->helper('link');
        foreach ($_data_link_array as &$_data_link)
        {
            if($_data_link->{$_label_titre} && $_data_link->{$_label_id})
            {
                $_data_link->{$_link} = site_url($this->access_label.'/'.$_target.'_'.to_ascii($_data_link->{$_label_titre}).'_'.$_data_link->{$_label_id});
            }
        }
    }

    protected function _format_all_notes(&$_data_notes_array)
    {
        $map_class_notes = config_item('notes_classes');
        foreach ($_data_notes_array as &$_data_note)
        {
            if($_data_note->moyenne_note && isset($map_class_notes[$_data_note->moyenne_note]))
            {
                $_data_note->class_note = $map_class_notes[$_data_note->moyenne_note];
            }
        }
    }
}

/* End of file */
