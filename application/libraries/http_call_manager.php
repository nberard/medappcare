<?php
require_once APPPATH.'libraries/WsCaller/ACaller.php';
require_once APPPATH.'libraries/WsCaller/Curl.php';
require_once APPPATH.'libraries/WsCaller/Fgc.php';
class http_call_manager extends WsCallManager {

    public function __construct($_params = null)
    {
        parent::__construct(array(
                'contentType' => $_params ? ACaller::HTTP_CALLER_CONTENT_CLEAR : ACaller::HTTP_CALLER_CONTENT_TYPE_JSON,
                'ws_call' => WsCallManager::HTTP_WS_CALL_FGC)
        );
    }

}

class WsCallManager
{
    const HTTP_WS_CALL_CURL = 'curl';
    const HTTP_WS_CALL_FGC = 'fgc';
    private $wsSettings;
    private $caller;

    public function __construct($wsSettings)
    {
        $this->wsSettings = $wsSettings;
        if($this->wsSettings['ws_call'] == self::HTTP_WS_CALL_CURL)
            $this->caller = new Curl($this->wsSettings);
        else $this->caller = new Fgc($this->wsSettings);
    }
    
    public function call($method, $target, $params, $entityUrl)
    {
        if(empty($entityUrl))
            $entityUrl = $this->wsSettings['url'];
        $fullTarget = $entityUrl."/$target/".$params;
        $this->caller->setUrl($fullTarget);
        echo("[WS CALL] calling $fullTarget with ".$this->wsSettings['ws_call']);
        log_message('info',"[WS CALL] calling $fullTarget with ".$this->wsSettings['ws_call']);
        switch($method)
        {
            case "GET":
                try
                {
                    return $this->caller->sendGetRequest();
                }
                catch(Exception $e)
                {
                    throw $e;
                }
            break;
            case "POST":
                return $this->caller->sendPostRequest();
            break;
            case "PUT":
                return $this->caller->sendPutRequest();
            break;
            case "DELETE":
                return $this->caller->sendDeleteRequest();
            break;
            default:
                throw new \Exception('[WSCallManager: unimplemented method : "'.$method.'"');
        }
    }
}
