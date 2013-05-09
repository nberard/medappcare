<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('format_price'))
{
    function  format_price ($_price, $_currency, $_free_label)
    {
        $currency_map = config_item('currency_map');
        return $_price == 0.00 ? $_free_label :
            (empty($currency_map[$_currency]) ? $_price. ' '.$_currency :
                $_price.$currency_map[$_currency]);
    }
}
