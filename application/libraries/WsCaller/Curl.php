<?php

class Curl extends ACaller
{
    /**
     * @var resource
     */
    private $curl;
    
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
        echo 'setUrl='.var_export($url,true);
        curl_setopt($this->curl, CURLOPT_URL, $url);
    }
    
    public function __destruct()
    {
        curl_close($this->curl);
    }
    
    /**
     * Sends a GET HTTP request
     * @return Ambigous <NULL, mixed>
     */
    public function sendGetRequest()
    {
        $response = curl_exec($this->curl);
        
        return $this->formatResponse($response);
    }
    
    /**
     * Sends a PUT HTTP request
     * @param array $params
     * @return mixed
     */
    public function sendPutRequest(array $params)
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($params));

        return curl_exec($this->curl);
    }
    
    /**
     * Sends a POST HTTP request
     * @param array $params
     * @return mixed
     */
    public function sendPostRequest(array $params)
    {
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $params);
        
        return curl_exec($this->curl);
    }
    
    /**
     * Sends a DELETE HTTP request
     * @return mixed
     */
    public function sendDeleteRequest()
    {
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
        
        return curl_exec($this->curl);
    }

    /**
     * Initialize Curl and sets the default options
     */
    private function init()
    {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array(
            'Accept: ' . $this->acceptContent,
            'Charset: ' . $this->charset,
        ));
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
    }
}
