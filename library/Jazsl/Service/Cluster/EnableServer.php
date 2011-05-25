<?php
class Jazsl_Service_Cluster_EnableServer extends Jazsl_Service_RequestAbstract
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
    protected $_httpPath = '/ZendServerManager/Api/clusterEnableServer';
    /**
     *
     * @var int
     */
    protected $_serverID;
    /**
     *
     * @var Zend_Http_Client
     */
    protected $_httpClient;
    /**
     *
     * @param array $servers
     */
    public function setServer ($server)
    {
        $this->_serverID = $server;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $auth->signRequest($this->_httpClient);
        if (null === $this->_serverID) {
            throw new Exception('serverID must be set');
        }
        $this->_httpClient->setParameterPost('serverID', $this->_serverID);
        $this->_response = $this->_httpClient->request(Zend_Http_Client::POST);
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