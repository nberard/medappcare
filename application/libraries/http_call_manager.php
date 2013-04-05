<?php
require_once APPPATH.'libraries/WsCaller/ACaller.php';
require_once APPPATH.'libraries/WsCaller/Curl.php';
require_once APPPATH.'libraries/WsCaller/Fgc.php';
class http_call_manager extends WsCallManager {

    public function __construct($_logger = null)
    {
        parent::__construct(array('contentType' => ACaller::HTTP_CALLER_CONTENT_TYPE_JSON, 'ws_call' => WsCallManager::HTTP_WS_CALL_FGC));
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
        error_log("[WS CALL] calling $fullTarget with ".$this->wsSettings['ws_call']);
        switch($method)
        {
            case "GET":
                return $this->caller->sendGetRequest();
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
