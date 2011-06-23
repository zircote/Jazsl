<?php
class Jazsl_Server_GetSystemInfo extends Jazsl_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/getSystemInfo';
    /**
     *
     * @var int
     */
    protected $_serverId;
    /**
     *
     * @param Jazsl_Auth $auth
     */
    public function request (Jazsl_Auth $auth)
    {
        $this->_setHeaders();
        $auth->signRequest($this->getHttpClient());
        if (null === $this->_serverId) {
            throw new Exception('serverId must be set');
        }
        $this->_response = $this->getHttpClient()->request(Zend_Http_Client::POST);
        if (300 > $this->_response->getStatus()) {
            return new Jazsl_Response_ServerInfo(
                $this->_response->getBody()
            );
        } else {
            return new Jazsl_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
}