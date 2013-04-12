<?php

abstract class ACaller {

    const HTTP_CALLER_CONTENT_TYPE_JSON = 'application/json';
    const HTTP_CALLER_CONTENT_TYPE_XML = 'application/xml';
    const HTTP_CALLER_CONTENT_CLEAR = '';
    const HTTP_CALLER_CHARSET_UTF8 = 'UTF-8';
    private $renderType;
    protected $errorCodes;
    protected $acceptContent;
    protected $charset;
    
    public function __construct($wsSettings)
    {
        if(!in_array($wsSettings['contentType'], array(
                                                    self::HTTP_CALLER_CONTENT_TYPE_XML,
                                                    self::HTTP_CALLER_CONTENT_TYPE_JSON,
                                                    self::HTTP_CALLER_CONTENT_CLEAR
                                                )))
        {
            throw new \Exception('[WSCallManager] wrong ws config settings passed');
        }
        else
        {
            $this->renderType = $wsSettings['contentType'];
            $this->acceptContent = $wsSettings['contentType'];
            $this->charset = self::HTTP_CALLER_CHARSET_UTF8;
        }
        $this->errorCodes = array(400, 403, 404);
    }
    
    public abstract function setUrl($url);
    public abstract function sendGetRequest();
    public abstract function sendPutRequest(array $params);
    public abstract function sendPostRequest(array $params);
    public abstract function sendDeleteRequest();
    
    /**
     * Formats the response depending on the content type
     * @param string $response
     * @return string
     */
    protected function formatResponse($data)
    {
        $formatedResponse = null;
        
        if($this->renderType == self::HTTP_CALLER_CONTENT_TYPE_XML)
        {
            require_once './xmlConvertor/XML2Array.php';
            return XML2Array::createArray($data);
        }      
        else if($this->renderType == self::HTTP_CALLER_CONTENT_TYPE_JSON){
            $decodedData = json_decode($data,true);
            if($decodedData === NULL)
                throw new \Exception('[WSCallManager:json_decode] The input json object cannot be decoded : "'.$data.'"');
            return $decodedData;
        } 
        else
        {
            return $data;
        }
    }

    protected function _getHttpResponseStatusCode($url) {
        $headers = get_headers($url);
        return substr($headers[0], 9, 3);
    }
}