<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_crypt_password'))
{
    function get_crypt_password($_password)
    {
        return empty($_password) ? '' : md5(config_item('password_salt').$_password);
    }
}