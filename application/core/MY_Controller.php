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

    protected function _format_all_links(&$_data_link_array, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id', $_page = 0, $_revert_access = false)
    {
        foreach ($_data_link_array as &$_data_link)
        {
            if($_data_link->{$_label_titre} && $_data_link->{$_label_id})
            {
                $this->_format_link($_data_link, $_target, $_label_titre, $_link, $_label_id, $_page, '', $_revert_access);
            }
        }
    }

    protected function _format_all_links_categorie(&$_data_link_array, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id')
    {
        foreach ($_data_link_array as &$_data_link)
        {
            if($_data_link->{$_label_titre} && $_data_link->{$_label_id})
            {
                $this->_format_link($_data_link, $_target, $_label_titre, $_link, $_label_id, 0, '', $this->pro != $_data_link->est_pro);
            }
        }
    }

    protected function _format_link(&$_data_link, $_target, $_label_titre = 'titre', $_link = 'link', $_label_id = 'id', $_page = 0, $_params = '', $_revert_access = false)
    {
        $this->load->helper('url');
        $this->load->helper('format_string');
        log_message('debug', "_revert_access=".var_export($_revert_access, true));
        $access_label = $_revert_access ? $this->access_label_target : $this->access_label;
        log_message('debug', "access_label=".var_export($access_label, true));
        $path = $access_label.'/'.$_target.'/'.to_ascii($_data_link->{$_label_titre}).'_'.$_data_link->{$_label_id};
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

    protected function _format_all_dates(&$_data_dates_array, $_label_date = 'date', $_type_date = 'date')
    {
        foreach ($_data_dates_array as &$_data_date)
        {
            if($_data_date->{$_label_date})
            {
                $this->load->helper('date');
                if($_type_date == 'date')
                {
                    $_data_date->date_full = date_full($_data_date->{$_label_date});
                }
                else if($_type_date == 'datetime')
                {
                    $_data_date->date_full = date_time_full($_data_date->{$_label_date});
                }
            }
        }
    }

    protected function _format_link_no_id($_target, $_page = 0, $_params = array())
    {
//        log_message('debug', "_format_link_no_id($_target, $_page = 0, =".var_export($_params, true)."");
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
                else if(!is_null($value))
                {
                    $link.= $key.'='.$value.'&';
                }
            }
        }
//        log_message('debug', "link=".var_export($link, true)."");
        return $link;
    }

    protected function _populate_categories_application(&$_application)
    {
        $this->load->model('Categories_model');
        $_application->categories = $this->Categories_model->get_categories_from_application($_application->id);
        $this->_format_all_links_categorie($_application->categories, 'category', 'nom', 'link_categorie');
    }

    protected function _populate_categories_applications(&$_applications)
    {
        foreach($_applications as &$application)
        {
            $this->_populate_categories_application($application);
        }
    }

    protected function _format_all_notes(&$_data_notes_array, $_notes_to_format = array('note_medappcare'))
    {
        foreach ($_data_notes_array as &$_data_note)
        {
            $this->_format_note($_data_note, $_notes_to_format);
        }
    }

    protected function _format_note(&$_data_note, $_notes_to_format = array('note'))
    {
//        log_message('debug', "_format_note=".var_export($_data_note, true)."=".var_export($_notes_to_format, true)."");
        $map_class_notes = config_item('notes_classes');
        foreach($_notes_to_format as $_note_to_format)
        {
            if(isset($_data_note->{"moyenne_".$_note_to_format}) && isset($map_class_notes[$_data_note->{"moyenne_".$_note_to_format}]))
            {
                $_data_note->{"class_".$_note_to_format} = $map_class_notes[$_data_note->{"moyenne_".$_note_to_format}];
            }
        }
    }

    protected function _validation_get_errors()
    {
        $errors = array();
        foreach($_POST as $key => $value)
        {
            $error = form_error($key);
            if($error)
            {
//                log_message('debug', "adding $error for $key");
                $errors[] = $error;
            }
        }
        return $errors;
    }
}

/* End of file */
