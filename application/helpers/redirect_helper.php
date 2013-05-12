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