<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class apple_feeder extends ApplicationFeeder {

    private $device;

    public function __construct($_params)
    {
        parent::__construct($_params[0], $_params[1], $_params[2]);
        $this->device = ApplicationFeeder::APPLICATION_DEVICE_APPLE;
    }

    public function feed($_langue_store, $_langue_appli)
    {
        foreach($this->items as $item)
        {
            if(!$this->applicationModel->exists_applications(array('package' => $item["id"]["attributes"]["im:bundleId"])))
            {
                $editeur_id = $this->editeurModel->exists_editeurs(array('nom' => $item["im:artist"]["label"]));
                if(!$editeur_id)
                {
                    $editeur_id = $this->editeurModel->insert_editeurs($item["im:artist"]["label"], $item["im:artist"]["attributes"]["href"]);
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
                    $item["link"][0]["attributes"]["href"],
                    $item["im:releaseDate"]["attributes"]["label"]))
                    echo $item["im:name"]["label"]." done <br/>";
                    else echo $item["im:name"]["label"]." failed <br/>";

            }
            else
            {
                echo 'package '.$item["im:name"]["label"].' already exists <br/>';
            }
        }
    }

}