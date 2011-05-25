<?php
/**
 *
 * @author zircote
 *
 */
class Jazsl_Service_Cluster_GetServerStatus
extends Jazsl_Service_RequestAbstract
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
    protected $_httpPath = '/ZendServerManager/Api/clusterGetServerStatus';
    /**
     *
     * @var array|null
     */
    protected $_params;
    /**
     *
     * @var Zend_Http_Client
     */
    protected $_httpClient;
    /**
     *
     * @param array $servers
     */
    public function setServers (array $servers)
    {
        $this->_params['servers'] = $servers;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $auth->signRequest($this->_httpClient);
        $this->_httpClient->setParameterGet(
            'servers', $this->_params['servers']
        );
        $this->_response = $this->_httpClient->request();
        if (300 > $this->_response->getStatus()) {
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