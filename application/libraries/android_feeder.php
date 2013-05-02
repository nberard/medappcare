<?php
require_once APPPATH.'libraries/AppFeeder/ApplicationFeeder.php';
class android_feeder extends ApplicationFeeder {

    const DOWNLOAD_LINK_PREFIX = 'https://play.google.com/store/apps/details?id=';
    const FREE_LABEL = 'Free';
    const DEFAULT_CURRENCY = 'USD';

    public function __construct($_params)
    {
        parent::__construct($_params[0], $_params[1], $_params[2], $_params[3]);
    }

    public function feed($_langue_store, $_langue_appli)
    {
        $return = array();
//        var_dump($this->items);return;
        foreach($this->items as $item)
        {
//            var_dump($item);
            $lien = self::DOWNLOAD_LINK_PREFIX.$item["package_name"];
            if($item['price'] == self::FREE_LABEL)
            {
                $prix = 0;
                $devise = self::DEFAULT_CURRENCY;
            }
            else if(preg_match('/\$([0-9]+(\.[0-9]+)?)/', $item['price'], $matches) && !empty($matches[1]))
            {
                $prix = $matches[1];
                $devise = self::DEFAULT_CURRENCY;
            }
            else
            {
                log_message('error','**************price wrong : '.$item['price']);
                continue;
            }
            if(!$this->applicationModel->exists_applications(array(
                    'langue_store' => $_langue_store,
                    'package' => $item["package_name"],
                    'lien_download' => $lien,
                    'device_id' => $this->device,
                    'devise' => $devise,
                ),
                array(
                    'prix' => $prix,
                )))
            {
                $editeur_id = $this->editeurModel->exists_editeurs(array('nom' => $item["developer"]));
                if(!$editeur_id)
                {
                    $url = isset($item["developer_url"]) ? $item["developer_url"] : '';
                    $editeur_id = $this->editeurModel->insert_editeurs($item["developer"], $url);
                }
                $screens = $item["screenshots"];
                if($this->applicationModel->insert_applications(
                    $item["name"],
                    $item["package_name"],
                    $this->device,
                    $item["name"],
                    $item["description"],
                    $prix,
                    $devise,
                    $_langue_store,
                    $_langue_appli,
                    $editeur_id,
                    -1,
                    $lien,
                    $item['icon_full'],
                    $item["version"]
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
                    echo $item["package_name"]." done <br/>";

                    $return[] = $item["package_name"];
                    log_message('info',$item["package_name"].' done ');
                }
                else
                {
                    echo $item["package_name"]." failed <br/>";
                    log_message('info',$item["package_name"].' failed ');
                }

            }
            else
            {
                echo 'package '.$item["package_name"].' already exists <br/>';
                log_message('info',$item["package_name"].' already exists ');
            }
        }
        return $return;
    }

}