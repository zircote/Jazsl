<?php
class Jazsl_Response_SystemInfo
{
    /**
     *
     * @var string
     */
    protected $_status;
    /**
     *
     * @var string
     */
    protected $_edition;
    /**
     *
     * @var string
     */
    protected $_zendServerVersion;
    /**
     *
     * @var array
     */
    protected $_supportedApiVersions;
    /**
     *
     * @var string
     */
    protected $_phpVersion;
    /**
     *
     * @var string
     */
    protected $_operatingSystem;
    /**
     *
     * @var Jazsl_Response_LicenseInfo
     */
    protected $_serverLicenseInfo;
    /**
     *
     * @var _managerLicenseInfo
     */
    protected $_managerLicenseInfo;
    /**
     *
     * @var Jazsl_Response_MessageList|void
     */
    protected $_messageList;
    /**
     *
     * @throws ErrorException
     * @param string|SimpleXMLElement $xml
     */
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = @simplexml_load_string($xml);
            if(!$xml){
                throw new ErrorException(
                    'response xml unabled to parse', 500, E_ERROR, __FILE__,
                    __LINE__
                );
            }
            $xml = $xml->responseData->systemInfo;
        }
        $this->_status = trim((string) $xml->status);
        $this->_edition = trim((string) $xml->edition);
        $this->_zendServerVersion = trim((string) $xml->zendServerVersion);
        $this->_supportedApiVersions = $this->_setApiVersion(
            $xml->supportedApiVersions
        );
        $this->_phpVersion = trim((string) $xml->phpVersion);
        $this->_operatingSystem = trim((string) $xml->operatingSystem);
        $this->_serverLicenseInfo = new Jazsl_Response_LicenseInfo(
            $xml->serverLicenseInfo
        );
        $this->_managerLicenseInfo = new Jazsl_Response_LicenseInfo(
            $xml->managerLicenseInfo
        );
    }
    protected function _setApiVersion (SimpleXMLElement $supportedApiVersions)
    {
        return explode(',', trim((string) $supportedApiVersions));
    }
	/**
     * @return string
     */
    public function getStatus ()
    {
        return $this->_status;
    }

	/**
     * @return string
     */
    public function getEdition ()
    {
        return $this->_edition;
    }

	/**
     * @return string
     */
    public function getZendServerVersion ()
    {
        return $this->_zendServerVersion;
    }

	/**
     * @return array
     */
    public function getSupportedApiVersions ()
    {
        return $this->_supportedApiVersions;
    }

	/**
     * @return string
     */
    public function getPhpVersion ()
    {
        return $this->_phpVersion;
    }

	/**
     * @return string
     */
    public function getOperatingSystem ()
    {
        return $this->_operatingSystem;
    }

	/**
     * @return Jazsl_Response_LicenseInfo
     */
    public function getServerLicenseInfo ()
    {
        return $this->_serverLicenseInfo;
    }

	/**
     * @return Jazsl_Response_LicenseInfo
     */
    public function getManagerLicenseInfo ()
    {
        return $this->_managerLicenseInfo;
    }

	/**
     * @return Jazsl_Response_MessageList
     */
    public function getMessageList ()
    {
        return $this->_messageList;
    }

}