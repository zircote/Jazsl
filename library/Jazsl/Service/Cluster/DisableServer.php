<?php
class Jazsl_Service_Cluster_DisableServer extends Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/clusterDisableServer';
    /**
     *
     * @var int
     */
    protected $_serverId;
    /**
     *
     * @param array $servers
     */
    public function setServerId ($server)
    {
        $this->_serverId = $server;
        return $this;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $this->_setHeaders();
        $auth->signRequest($this->getHttpClient());
        if (null === $this->_serverId) {
            throw new Exception('serverId must be set');
        }
        $this->getHttpClient()->setParameterPost('serverId', $this->_serverId);
        $this->_response = $this->getHttpClient()->request(
            Zend_Http_Client::POST
        );
        if (300 > $this->_response->getStatus()) {
            return new Jazsl_Service_Response_ServerInfo(
                $this->_response->getBody()
            );
        } else {
            return new Jazsl_Service_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
}