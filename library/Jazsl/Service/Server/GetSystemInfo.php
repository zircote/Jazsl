<?php
class Jazsl_Service_Server_GetSystemInfo extends Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/ZendServerManager/Api/getSystemInfo';
    /**
     *
     * @var int
     */
    protected $_serverId;
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $auth->signRequest($this->getHttpClient());
        if (null === $this->_serverId) {
            throw new Exception('serverId must be set');
        }
        $this->_setHeaders();
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
}