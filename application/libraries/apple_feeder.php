<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class apple_feeder extends ApplicationFeeder {

    public function __construct($_applicationModel, $_items)
    {
        parent::__construct($_applicationModel, $_items);
    }

}