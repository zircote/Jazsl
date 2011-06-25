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
     * @param Jazsl_Auth $auth
     */
    public function request (Jazsl_Auth $auth)
    {
        $this->_setHeaders();
        $auth->signRequest($this->getHttpClient());
        $this->_response = $this->getHttpClient()->request(Zend_Http_Client::GET);
        if (300 > $this->_response->getStatus()) {
            return new Jazsl_Response_SystemInfo(
                $this->_response->getBody()
            );
        } else {
            return new Jazsl_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
	/**
     * @param string $_httpPath
     * @return Jazsl_Server_GetSystemInfo
     */
    public function setHttpPath ($_httpPath)
    {
        $this->_httpPath = $_httpPath;
        return $this;
    }

}