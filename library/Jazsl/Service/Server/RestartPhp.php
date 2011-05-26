<?php
class Jazsl_Service_Server_RestartPhp extends Jazsl_Service_RequestAbstract
{
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
    protected $_parallelRestart = self::PARAM_FALSE;
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
        $this->_parallelRestart = $this->_convertBool($parallelRestart);
        return $this;
    }
    /**
     *
     * @param array $servers
     */
    public function setServers (array $servers)
    {
        $this->_servers = $servers;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $auth->signRequest($this->getHttpClient());
        if (null !== $this->_servers) {
            $this->getHttpClient()->setParameterPost(
                'servers', $this->_servers
            );
        }
        $this->getHttpClient()->setParameterPost(
            'parallelRestart', $this->getParallelRestart()
        );
        $this->_setHeaders();
        $this->_response = $this->getHttpClient()->request('POST');
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