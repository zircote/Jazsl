<?php
require_once 'Zend/Uri/Http.php';
require_once 'Zend/Http/Client.php';
class Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var Zend_Http_Client
     */
    protected $_httpClient;
    const USER_AGENT = 'JAZSL/0.1.0';
    const API_ACCEPT = 'application/vnd.zend.serverapi+xml;version=1.0';
    const PARAM_FALSE = 'false';
    const PARAM_TRUE = 'true';
    protected $_timeout = 60;
    protected $_httpPath;
    /**
     *
     * @var Zend_Http_Response
     */
    protected $_response;
    /**
     * @return Zend_Http_Client
     */
    public function getHttpClient ()
    {
        return $this->_httpClient;
    }
    /**
     * @return the $_timeout
     */
    public function getTimeout ()
    {
        return $this->_timeout;
    }
    public function getHttpPath(){
        return $this->_httpPath;
    }
    /**
     * @todo add support for Zend_Uri as a parameter
     * @param string $zendServer
     */
    public function __construct ($zendServer = 'https://localhost:10082')
    {
        if (is_string($zendServer) && (! Zend_Uri_Http::check($zendServer))) {
            throw new Exception('invalid uri');
        }
        $uri = Zend_Uri_Http::fromString($zendServer);
        $uri->setPath($this->_httpPath);
        $this->_httpClient = new Zend_Http_Client($uri->getUri());
    }

    protected function _setHeaders(){
        $this->getHttpClient()->setHeaders('timeout', $this->getTimeout());
        $this->getHttpClient()->setHeaders('Content-type', 'application/x-www-form-urlencoded');
        $this->getHttpClient()->setHeaders('User-Agent', self::USER_AGENT);
    }

    protected function _convertBool($value)
    {
        if( ! is_bool($value)){
            $value = strtolower($value);
        }
        if ( $value == true || $valus == self::PARAM_TRUE ) {
            return self::PARAM_TRUE;
        }
        return self::PARAM_FALSE;
    }
}
