<?php
/**
 *
 * @author zircote
 *
 */
class Jazsl_Service_Config_Import extends Jazsl_Service_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/configurationImport';
    /**
     *
     * @var string
     */
    protected $_filename;
    /**
     *
     * @var string 'false'|'true'
     */
    protected $_ignoreSystemMismatch = self::PARAM_FALSE;

    /**
     *
     * @param array $servers
     */
    public function setFilename ($filename)
    {
        if (!file_exists($filename) && is_file($filename)) {
            throw new Exception('file:['. $filename .'] was not found');
        }
        $this->_filename = $filename;
    }
    /**
     *
     * @param Jazsl_Service_Auth $auth
     */
    public function request (Jazsl_Service_Auth $auth)
    {
        $this->_setHeaders();
        $auth->signRequest($this->getHttpClient());
        $fp = fopen($this->_filename, "r");
        $this->_httpClient->setFileUpload($this->_filename, 'configFile');
        $this->_response = $this->getHttpClient()
            ->request('POST');
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
    /**
     * @return the $_ignoreSystemMismatch
     */
    public function getIgnoreSystemMismatch ()
    {
        return $this->_ignoreSystemMismatch;
    }

    /**
     * @param string $_ignoreSystemMismatch
     * @return Jazsl_Service_Config_Import
     */
    public function setIgnoreSystemMismatch ($_ignoreSystemMismatch)
    {
        if (
            $_ignoreSystemMismatch == true ||
            strtolower($_ignoreSystemMismatch) == self::PARAM_TRUE
        ) {
            $this->_ignoreSystemMismatch = self::PARAM_TRUE;
        }
        if (
            $_ignoreSystemMismatch == false ||
            strtolower($_ignoreSystemMismatch) == self::PARAM_FALSE
        ) {
            $this->_ignoreSystemMismatch = self::PARAM_FALSE;
        }
        $this->_ignoreSystemMismatch = $_ignoreSystemMismatch;
        return Jazsl_Service_Config_Import;
    }
}