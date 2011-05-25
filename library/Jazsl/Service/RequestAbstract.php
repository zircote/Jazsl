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
    protected $_httpSchema = 'https';
    protected $_httpPort = '10082';
    protected $_httpPath;
    const USER_AGENT = 'JAZSL/0.1.0';
    const API_ACCEPT = 'application/vnd.zend.serverapi+xml;version=1.0';
    const PARAM_FALSE = 'false';
    const PARAM_TRUE = 'true';
    protected $_timeout = 60;
    /**
     * @return the $_httpClient
     */
    public function getHttpClient ()
    {
        return $this->_httpClient;
    }
    /**
     * @return the $_httpSchema
     */
    public function getHttpSchema ()
    {
        return $this->_httpSchema;
    }
    /**
     * @return the $_httpPort
     */
    public function getHttpPort ()
    {
        return $this->_httpPort;
    }
    /**
     * @return the $_httpPath
     */
    public function getHttpPath ()
    {
        return $this->_httpPath;
    }
    /**
     * @return the $_timeout
     */
    public function getTimeout ()
    {
        return $this->_timeout;
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
        $this->_httpClient = new Zend_Http_Client(
            $uri->getUri(),
            array('timeout' => $this->_timeout,
            'Content-type' => 'application/x-www-form-urlencoded')
        );
        $this->_httpClient->setHeaders('User-Agent', self::USER_AGENT);
    }
}
