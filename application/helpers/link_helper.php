<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('redirect_language'))
{
    function redirect_language($_segments, $_languageTo)
    {
        $_segments[1] = $_languageTo;
        if(empty($_segments[2]))
        {
            $_segments[2] = 'index';
        }
        $url = implode('/',$_segments);
        return site_url($url);
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