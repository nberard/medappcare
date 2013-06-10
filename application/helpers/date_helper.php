<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('date_full'))
{
    function  date_full($_date)  {
        $tab_date = explode('-', $_date);
        $timestamp = mktime (0 , 0, 0, intval($tab_date[1]),intval($tab_date[2]),intval($tab_date[0]));
        $mois = date('F', $timestamp);
        if(config_item('lng') == 'en')
        {
            return sprintf(lang('date_format'), lang($mois), $tab_date[2], $tab_date[0]);
        }
        else
        {
            return sprintf(lang('date_format'), $tab_date[2], lang($mois), $tab_date[0]);
        }
    }

    function  date_time_full($_date)  {
        $tab_date_all = explode(' ', $_date);
        $tab_date = explode('-', $tab_date_all[0]);
        $tab_time = explode(':', $tab_date_all[1]);
        $timestamp = mktime (intval($tab_time[0]) , intval($tab_time[1]), intval($tab_time[2]), intval($tab_date[1]),intval($tab_date[2]),intval($tab_date[0]));
        $mois = date('F', $timestamp);
        if(config_item('lng') == 'en')
        {
            return sprintf(lang('date_time_format'), lang($mois), $tab_date[2], $tab_date[0], $tab_time[0], $tab_time[1]);
        }
        else
        {
            return sprintf(lang('date_time_format'), $tab_date[2], lang($mois), $tab_date[0], $tab_time[0], $tab_time[1]);
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
