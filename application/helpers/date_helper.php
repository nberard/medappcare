<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('date_full'))
{
    function  date_full($_date)  {
        $tab_date = explode('-', $_date);
        $timestamp = mktime (0 , 0, 0, intval($tab_date[1]),intval($tab_date[2]),intval($tab_date[0]));
        $mois = date('F', $timestamp);
        if(config_item('lng') == 'en')
        {
            return sprintf(lang('date_news'), lang($mois), $tab_date[2], $tab_date[0]);
        }
        else
        {
            return sprintf(lang('date_news'), $tab_date[2], lang($mois), $tab_date[0]);
        }
    }
}
if(!function_exists('date_classic'))
{
    function date_classic($_date)
    {
        $tab_date = explode('-', $_date);
        return $tab_date[2].'/'.$tab_date[1].'/'.$tab_date[0];
    }
}
if(!function_exists('date_to_date_mysql'))
{
    function date_to_date_mysql($_date)
    {
        $tab_date = explode('/', $_date);
        return $tab_date[2].'-'.$tab_date[1].'-'.$tab_date[0];
    }
}
