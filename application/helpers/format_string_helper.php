<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('short_html_text'))
{
    function short_html_text($_text, $_limit = 80)
    {
        $_text = strip_tags($_text);
        if(defined('ENT_HTML401'))
        {
            $text = html_entity_decode($_text, ENT_COMPAT | ENT_HTML401, 'UTF-8');
        }
        else
        {
            $text = html_entity_decode($_text, ENT_COMPAT, 'UTF-8');
        }
        return strlen($text) < $_limit ? $text : substr($text, 0, $_limit).' ...';
    }
}

if ( ! function_exists('to_ascii'))
{
    function to_ascii($str, $replace=array(), $delimiter='-')
    {
        if(!empty($replace))
        {
            $str = str_replace((array)$replace, ' ', $str);
        }
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower(trim($clean));
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

        return $clean;
    }
}

if ( ! function_exists('request_get_param'))
{
    function request_get_param($_array, $_index, $_default_value = null, $_authorized_values = array(), $_xss_clean = true)
    {
        if(isset($_array[$_index]))
        {
            $value = $_array[$_index];
            if($_xss_clean)
            {
                $instanceName =& get_instance();
                $instanceName->load->helper('security');
                $value = xss_clean($value);
            }
            if(!empty($_authorized_values))
            {
                if(in_array($value, $_authorized_values))
                {
                    return $value;
                }
            }
            else
            {
                return $value;
            }
        }
        return $_default_value;
    }
}

