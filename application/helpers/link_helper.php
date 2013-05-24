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

if ( ! function_exists('qr_code_url'))
{
    function qr_code_url($_url, $_size = 150)
    {
        $prefixe = config_item('qr_code_url');
        $target = urlencode($_url);
        return $prefixe.'?chs='.$_size.'x'.$_size.'&cht=qr&chl='.$target.'&choe='.config_item('charset');
    }
}
