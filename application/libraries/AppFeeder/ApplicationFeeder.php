<?php
/**
 * Created by JetBrains PhpStorm.
 * User: n.berard
 * Date: 04/04/13
 * Time: 16:27
 * @property Applications_model $applicationModel
 * @property Applications_screenshots_model $applicationScreenshotModel
 * @property Editeurs_model $editeurModel
 */
abstract class ApplicationFeeder
{

    protected $applicationModel;
    protected $applicationScreenshotModel;
    protected $spoolCrawlApplicationModel;
    protected $editeurModel;
    protected $items;
    protected $device;

    public function __construct($_applicationModel, $_editeurModel, $_applicationScreenshotModel, $_device, $_spoolCrawlApplicationModel)
    {
        $this->applicationModel = $_applicationModel;
        $this->editeurModel = $_editeurModel;
        $this->applicationScreenshotModel = $_applicationScreenshotModel;
        $this->device = $_device;
        $this->spoolCrawlApplicationModel = $_spoolCrawlApplicationModel;
    }

    public function setItems($_items)
    {
        $this->items = $_items;
    }

    public abstract function feed($_langue_store, $_langue_appli);
}
