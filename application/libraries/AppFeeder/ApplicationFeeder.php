<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 04/04/13
 * Time: 16:27
 */
abstract class ApplicationFeeder
{
    private $applicationModel;
    private $items;

    public function __construct($_applicationModel, $_items)
    {
        $this->applicationModel = $_applicationModel;
        $this->items = $_items;
    }

    public abstract function feed();
}
