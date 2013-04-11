<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class android_feeder extends ApplicationFeeder {

    private $device;

    public function __construct($_params)
    {
        parent::__construct($_params[0], $_params[1], $_params[2], $_params[3], $_params[4]);
    }

    public function feed($_langue_store, $_langue_appli)
    {
        foreach($this->items as $item)
        {
            var_dump($item);exit;
//            if(!$this->applicationModel->exists_applications(array('package' => )))
//            {
//                $editeur_id = $this->editeurModel->exists_editeurs(array('nom' => ));
//                if(!$editeur_id)
//                {
//                    $editeur_id = $this->editeurModel->insert_editeurs(, );
//                }
//                $screens = array();
//                $lien = '';
//                foreach($item["link"] as $link)
//                {
//                    if(!empty($link['attributes']['im:assetType']) && $link['attributes']['im:assetType'] == "preview")
//                    {
//                        $screens[] = $link['attributes']['href'];
//                    }
//                    else $lien = $link['attributes']['href'];
//                }
//
//                if($this->applicationModel->insert_applications(
//                    $item["im:name"]["label"],
//                    $item["id"]["attributes"]["im:bundleId"],
//                    $this->device,
//                    $item["title"]["label"],
//                    $item["summary"]["label"],
//                    $item["im:price"]["attributes"]["amount"],
//                    $item["im:price"]["attributes"]["currency"],
//                    $_langue_store,
//                    $_langue_appli,
//                    $editeur_id,
//                    -1,
//                    $lien,
//                    $item["im:releaseDate"]["attributes"]["label"]))
//                {
//                    $application_id = $this->applicationModel->db->insert_id();
//                    foreach($screens as $screen)
//                    {
//                        $this->applicationScreenshotModel->insert_application_screenshots($screen, $application_id);
//                    }
//                    echo $item["im:name"]["label"]." done <br/>";
//                }
//                else
//                {
//                    echo $item["im:name"]["label"]." failed <br/>";
//                }
//
//            }
//            else
//            {
//                echo 'package '.$item["im:name"]["label"].' already exists <br/>';
//            }
//            var_dump($item);exit;
        }
    }

}