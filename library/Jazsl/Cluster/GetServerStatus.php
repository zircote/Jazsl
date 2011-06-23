<?php
/**
 *
 * @author zircote
 *
 */
class Jazsl_Cluster_GetServerStatus extends Jazsl_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/clusterGetServerStatus';
    /**
     *
     * @var array|null
     */
    protected $_servers;
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
     * @param Jazsl_Auth $auth
     */
    public function request (Jazsl_Auth $auth)
    {
        $this->_setHeaders();
        $auth->signRequest($this->getHttpClient());
        if (null !== $this->_servers) {
            $this->getHttpClient()->setParameterGet(
                'servers', $this->_servers
            );
        }
        $this->_response = $this->getHttpClient()->request();
        if (300 > $this->_response->getStatus()) {
            return new Jazsl_Response_ServersList(
                $this->_response->getBody()
            );
        } else {
            return new Jazsl_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
}