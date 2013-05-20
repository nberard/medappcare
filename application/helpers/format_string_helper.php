<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('short_html_text'))
{
    function short_html_text($_text, $_limit = 80)
    {
        $text = html_entity_decode(strip_tags($_text));
        return strlen($text) < $_limit ? $text : substr($text, 0, $_limit).' ...';
    }
}

