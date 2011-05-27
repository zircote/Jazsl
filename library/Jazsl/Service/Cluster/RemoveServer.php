<?php
class Jazsl_Service_Cluster_RemoveServer extends Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/clusterRemoveServer';
    /**
     *
     * @var int
     */
    protected $_serverId;
    /**
     *
     * @var string "false"|"true"
     */
    protected $_force = self::PARAM_FALSE;
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
        $this->_httpClient->setParameterPost('serverId', $this->_serverId);
        if( $this->getForce()){
            $this->getHttpClient()->setParameterPost(
                'force', $this->getForce()
            );
        }
        $this->_response = $this->getHttpClient()->request(Zend_Http_Client::POST);
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
    /**
     *
     * @param array $servers
     */
    public function setServerId ($serverId)
    {
        $this->_serverId = $serverId;
        return $this;
    }
	/**
     * @return the $_force
     */
    public function getForce ()
    {
        return $this->_force;
    }

	/**
     * @param string $_force
     * @return Jazsl_Service_Cluster_RemoveServer
     */
    public function setForce ($_force)
    {
        $this->_force = $this->_convertBool($_force);
        return $this;
    }


}