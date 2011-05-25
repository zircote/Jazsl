<?php
class Jazsl_Service_Cluster_AddServer extends Jazsl_Service_RequestAbstract
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
    protected $_httpPath = '/ZendServerManager/Api/clusterAddServer';

    protected $_serverName;
    protected $_serverUrl;
    protected $_guiPassword;
    protected $_propagateSettings = self::PARAM_FALSE;
    protected $_doRestart = self::PARAM_FALSE;
    /**
     *
     * @var Zend_Http_Client
     */
    protected $_httpClient;
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
        if (! $this->_serverName) {
            throw new Exception('serverName must be set');
        }
        $this->_httpClient->setParameterPost(
            'serverName', $this->getServerName()
        );
        if (! $this->_serverUrl) {
            throw new Exception('serverUrl must be set');
        }
        $this->_httpClient->setParameterPost(
            'serverURL', $this->getServerUrl()
        );
        if (! $this->_guiPassword) {
            throw new Exception('guiPassword must be set');
        }
        $this->_httpClient->setParameterPost(
            'guiPassword', $this->getGuiPassword()
        );
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
    /**
     * @return the $_serverName
     */
    public function getServerName ()
    {
        return $this->_serverName;
    }

    /**
     * @return the $_serverUrl
     */
    public function getServerUrl ()
    {
        return $this->_serverUrl;
    }

    /**
     * @return the $_guiPassword
     */
    public function getGuiPassword ()
    {
        return $this->_guiPassword;
    }

    /**
     * @return the $_propagateSettings
     */
    public function getPropagateSettings ()
    {
        return $this->_propagateSettings;
    }

    /**
     * @return the $_doRestart
     */
    public function getDoRestart ()
    {
        return $this->_doRestart;
    }

    /**
     * @param field_type $_serverName
     * @return Jazsl_Service_Cluster_AddServer
     */
    public function setServerName ($_serverName)
    {
        $this->_serverName = $_serverName;
        return $this;
    }

    /**
     * @param field_type $_serverUrl
     * @return Jazsl_Service_Cluster_AddServer
     */
    public function setServerUrl ($_serverUrl)
    {
        if (!Zend_Uri_Http::check($_serverUrl)) {
            throw new Exception('serverUrl is not well formed');
        }
        $this->_serverUrl = $_serverUrl;
        return $this;
    }

    /**
     * @param field_type $_guiPassword
     * @return Jazsl_Service_Cluster_AddServer
     */
    public function setGuiPassword ($_guiPassword)
    {
        $this->_guiPassword = $_guiPassword;
        return $this;
    }

    /**
     * @param field_type $_propagateSettings
     * @return Jazsl_Service_Cluster_AddServer
     */
    public function setPropagateSettings ($_propagateSettings)
    {
        if (
            $_propagateSettings == true ||
            strtolower($_propagateSettings) == self::PARAM_TRUE
        ) {
            $this->_propagateSettings = self::PARAM_TRUE;
        }
        if (
            $_propagateSettings == false ||
            strtolower($_propagateSettings) == self::PARAM_FALSE
        ) {
            $this->_propagateSettings = self::PARAM_FALSE;
        }
        return $this;
    }

    /**
     * @param field_type $_doRestart
     * @return Jazsl_Service_Cluster_AddServer
     */
    public function setDoRestart ($_doRestart)
    {
        if (
            $_doRestart == true || strtolower($_doRestart) == self::PARAM_TRUE
        ) {
            $this->_doRestart = self::PARAM_TRUE;
        }
        if (
            $_doRestart == false || strtolower($_doRestart) == self::PARAM_FALSE
        ) {
            $this->_doRestart = self::PARAM_FALSE;
        }
        return $this;
    }

}