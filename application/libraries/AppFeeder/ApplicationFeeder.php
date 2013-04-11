<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 04/04/13
 * Time: 16:27
 * @property Applications_model $applicationModel
 * @property Editeurs_model $editeurModel
 */
abstract class ApplicationFeeder
{

    const APPLICATION_DEVICE_APPLE = 1;
    const APPLICATION_DEVICE_ANDROID = 2;

    protected $applicationModel;
    protected $editeurModel;
    protected $items;

    public function __construct($_applicationModel, $_editeurModel, $_items)
    {
        $this->applicationModel = $_applicationModel;
        $this->editeurModel = $_editeurModel;
        $this->items = $_items;
    }

    public abstract function feed($_langue_store, $_langue_appli);
}
