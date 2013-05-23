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

    protected function _format_all_links(&$_data_link_array, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id', $_page = 0)
    {
        foreach ($_data_link_array as &$_data_link)
        {
            if($_data_link->{$_label_titre} && $_data_link->{$_label_id})
            {
                $this->_format_link($_data_link, $_target, $_label_titre, $_link, $_label_id, $_page);
            }
        }
    }

    protected function _format_link(&$_data_link, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id', $_page = 0, $_params = '')
    {
        $this->load->helper('url');
        $this->load->helper('format_string');
        $path = $this->access_label.'/'.$_target.'/'.to_ascii($_data_link->{$_label_titre}).'_'.$_data_link->{$_label_id};
        if($_page != 0)
        {
            $path.='_'.$_page;
        }
        $_data_link->{$_link} = site_url($path);
        if(!empty($_params))
        {
            $_data_link->{$_link}.='?';
            foreach($_params as $key => $value)
            {
                if(is_array($value))
                {
                    $_data_link->{$_link}.= $key.'='.implode(',',$value).'&';
                }
                else
                {
                    $_data_link->{$_link}.= $key.'='.$value.'&';
                }
            }
        }
    }

    protected function _format_link_no_id($_target, $_page = 0, $_params = '')
    {
        $this->load->helper('url');
        $path = $this->access_label.'/'.$_target;
        if($_page != 0)
        {
            $path.='_'.$_page;
        }
        $link = site_url($path);
        if(!empty($_params))
        {
            $link.='?';
            foreach($_params as $key => $value)
            {
                if(is_array($value))
                {
                    $link.= $key.'='.implode(',',$value).'&';
                }
                else
                {
                    $link.= $key.'='.$value.'&';
                }
            }
        }
        return $link;
    }

    protected function _populate_categories_application(&$_application)
    {
        $this->load->model('Categories_model');
        $_application->categories = $this->Categories_model->get_categories_from_application($_application->id);
        $this->_format_all_links($_application->categories, 'category', 'nom', 'link_categorie', 'id');
    }

    protected function _populate_categories_applications(&$_applications)
    {
        foreach($_applications as &$application)
        {
            $this->_populate_categories_application($application);
        }
    }

    protected function _format_all_notes(&$_data_notes_array, $_notes_to_format = array('note'))
    {
        foreach ($_data_notes_array as &$_data_note)
        {
            $this->_format_note($_data_note, $_notes_to_format);
        }
    }

    protected function _format_note(&$_data_note, $_notes_to_format = array('note'))
    {
        $map_class_notes = config_item('notes_classes');
        foreach($_notes_to_format as $_note_to_format)
        {
            if($_data_note->{"moyenne_".$_note_to_format} && isset($map_class_notes[$_data_note->{"moyenne_".$_note_to_format}]))
            {
                $_data_note->{"class_".$_note_to_format} = $map_class_notes[$_data_note->{"moyenne_".$_note_to_format}];
            }
        }
    }
}

/* End of file */
