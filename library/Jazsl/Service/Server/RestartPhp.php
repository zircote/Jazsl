<?php
class Jazsl_Service_Server_RestartPhp extends Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var Zend_Http_Response
     */
    protected $_response;
    /**
     *
     * @var string
     */
    protected $_httpPath = '/ZendServerManager/Api/restartPhp';
    /**
     *
     * @var array|null
     */
    protected $_servers;
    /**
     *
     * @var bool
     */
    protected $_parallelRestart = 'false';
    /**
     *
     * @var Zend_Http_Client
     */
    protected $_httpClient;
    /**
     * @return the $_parallelRestart
     */
    public function getParallelRestart ()
    {
        return $this->_parallelRestart;
    }
    /**
     * @param bool $_parallelRestart
     * @return Jazsl_Service_Server_RestartPhp
     */
    public function setParallelRestart ($parallelRestart = false)
    {
        if (! is_bool($parallelRestart)) {
            $parallelRestart = false;
        }
        $this->_parallelRestart = $parallelRestart;
        return $this;
    }
    /**
     *
     * @param array $servers
     */
    public function setServers (array $servers)
    {
        $this->_servers['servers'] = $servers;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $auth->signRequest($this->_httpClient);
        if (null !== $this->_servers) {
            $this->_httpClient->setParameterPost(
                'servers', $this->_servers['servers']
            );
        }
        $this->_httpClient->setParameterPost(
            'parallelRestart', $this->getParallelRestart()
        );
        $this->_response = $this->_httpClient->request('POST');
        if ('300' > $this->_response->getStatus()) {
            return new Jazsl_Service_Response_ServersList(
                $this->_response->getBody()
            );
        } else {
            return new Jazsl_Service_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
}