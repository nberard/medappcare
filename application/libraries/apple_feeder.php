<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class apple_feeder extends ApplicationFeeder {

    protected $device;

    public function __construct($_params)
    {
        parent::__construct($_params[0], $_params[1], $_params[2], $_params[3]);
    }

    public function feed($_langue_store, $_langue_appli)
    {
        log_message('debug','feed '.count($this->items).' items with langue store = '.$_langue_store);
//        error_log('items = '.var_export($this->items, true));
        foreach($this->items as $item)
        {
            $screens = array();
            $lien = '';
            $logo = '';
            foreach($item["link"] as $link)
            {
                if(!empty($link['attributes']['im:assetType']) && $link['attributes']['im:assetType'] == "preview")
                {
                    $screens[] = $link['attributes']['href'];
                }
                else $lien = $link['attributes']['href'];
            }
            if(!$this->applicationModel->exists_applications(array(
                    'langue_store' => $_langue_store,
                    'package' => $item["id"]["attributes"]["im:bundleId"],
                    'lien_download' => $lien,
                    'device_id' => $this->device,
                    'devise' => $item["im:price"]["attributes"]["currency"],
                ),
                array(
                    'prix' => $item["im:price"]["attributes"]["amount"],
                )))
            {
                $editeur_id = $this->editeurModel->exists_editeurs(array('nom' => $item["im:artist"]["label"]));
                if(!$editeur_id)
                {
                    $editeur_id = $this->editeurModel->insert_editeurs($item["im:artist"]["label"], $item["im:artist"]["attributes"]["href"]);
                }
                foreach($item["im:image"] as $image)
                {
                    if($image["attributes"]["height"] == 100)
                    {
                        $logo = $image["label"];
                    }
                }

                if($this->applicationModel->insert_applications(
                    $item["im:name"]["label"],
                    $item["id"]["attributes"]["im:bundleId"],
                    $this->device,
                    $item["title"]["label"],
                    $item["summary"]["label"],
                    $item["im:price"]["attributes"]["amount"],
                    $item["im:price"]["attributes"]["currency"],
                    $_langue_store,
                    $_langue_appli,
                    $editeur_id,
                    -1,
                    $lien,
                    $logo,
                    $item["im:releaseDate"]["attributes"]["label"]
                ))
                {
                    $application_id = $this->applicationModel->db->insert_id();
                    foreach($screens as $screen)
                    {
                        if(!$this->applicationScreenshotModel->exists_application_screenshots($screen, $application_id))
                        {
                            $this->applicationScreenshotModel->insert_application_screenshots($screen, $application_id);
                        }
                    }
                    echo $item["im:name"]["label"]." done <br/>";
                    log_message('info',$item["im:name"]["label"].' done ');
                }
                else
                {
                    echo $item["im:name"]["label"]." failed <br/>";
                    log_message('info',$item["im:name"]["label"].' failed ');
                }

            }
            else
            {
                echo 'package '.$item["im:name"]["label"].' already exists <br/>';
                log_message('info',$item["im:name"]["label"].' already exists ');
            }
//            var_dump($item);exit;
//            return;
        }
    }

}