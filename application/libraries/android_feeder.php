<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class android_feeder extends ApplicationFeeder {

    public function __construct($_params)
    {
        parent::__construct($_params[0], $_params[1], $_params[2], $_params[3], $_params[4]);
    }

    public function feed($_langue_store, $_langue_appli)
    {
        foreach($this->items as $item)
        {
            var_dump($item);continue;
            if(!$this->applicationModel->exists_applications(array('package' => $item["package_name"])))
            {
                $editeur_id = $this->editeurModel->exists_editeurs(array('nom' => $item["developer"]));
                if(!$editeur_id)
                {
                    $editeur_id = $this->editeurModel->insert_editeurs($item["developer"], $item["developer_url"]);
                }
                $screens = $item["screenshots"];
                if($this->applicationModel->insert_applications(
                    $item["name"],
                    $item["package_name"],
                    $this->device,
                    $item["name"],
                    $item["description"],
                    $item["im:price"]["attributes"]["amount"],
                    $item["im:price"]["attributes"]["currency"],
                    $_langue_store,
                    $_langue_appli,
                    $editeur_id,
                    -1,
                    $lien,
                    $logo,
                    $item["im:releaseDate"]["attributes"]["label"]))
                {
                    $application_id = $this->applicationModel->db->insert_id();
                    foreach($screens as $screen)
                    {
                        $this->applicationScreenshotModel->insert_application_screenshots($screen, $application_id);
                    }
                    echo $item["name"]." done <br/>";
                }
                else
                {
                    echo $item["name"]." failed <br/>";
                }

            }
            else
            {
                echo 'package '.$item["im:name"]["label"].' already exists <br/>';
            }
        }
    }

}