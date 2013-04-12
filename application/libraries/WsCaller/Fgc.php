<?php

class Fgc extends ACaller
{
    private $url;
    private $options;
    public function __construct($wsSettings)
    {
        parent::__construct($wsSettings);
        $this->init();
    }
    
    /**
     * Sets the url
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
    
    /**
     * Sends a GET HTTP request
     * @return Ambigous <NULL, mixed>
     */
    public function sendGetRequest()
    {
        $this->options['http']['method'] = "GET";
        $context = stream_context_create($this->options);
        $code = $this->_getHttpResponseStatusCode($this->url);
        if(!in_array($code, $this->errorCodes))
        {
            $response = file_get_contents($this->url,false,$context);
            return $this->formatResponse($response);
        }
        else
        {
            throw new Exception('Error', $code);
        }
    }
    
    /**
     * Sends a PUT HTTP request
     * @param array $params
     * @return mixed
     */
    public function sendPutRequest(array $params)
    {
        $this->options['http']['method'] = "PUT";
        throw new \Exception('[WSCallManager] Unimplemented call for PUT request');
    }
    
    /**
     * Sends a POST HTTP request
     * @param array $params
     * @return mixed
     */
    public function sendPostRequest(array $params)
    {
        $this->options['http']['method'] = "PUT";
        throw new \Exception('[WSCallManager] Unimplemented call for PUT request');
    }
    
    /**
     * Sends a DELETE HTTP request
     * @return mixed
     */
    public function sendDeleteRequest()
    {
        $this->options['http']['method'] = "DELETE";
        $context = stream_context_create($this->options);
        $response = file_get_contents($this->url,false,$context);
        
        return $this->formatResponse($response, $http_response_header);
    }

    /**
     * Initialize Curl and sets the default options
     */
    private function init()
    {
        $this->options = array(
          'http'=>array(
            'header' => "Accept: $this->acceptContent\r\nContent-Type: text/xml; charset=".strtolower($this->charset),
          )
        );
    }
}
