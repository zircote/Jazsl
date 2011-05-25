<?php
class Jazsl_Service_Response_SystemInfo
{
    protected $_status;
    protected $_edition;
    protected $_zendServerVersion;
    protected $_supportedApiVersions;
    protected $_phpVersion;
    protected $_operatingSystem;
    protected $_serverLicenseInfo;
    protected $_managerLicenseInfo;
    protected $_messageList;
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
            $xml = $xml->responseData->systemInfo;
        }
        $this->_status = (string) $xml->status;
        $this->_edition = (string) $xml->edition;
        $this->_zendServerVersion = (string) $xml->zendServerVersion;
        $this->_supportedApiVersions = $this->_setApiVersion(
            $xml->supportedApiVersions
        );
        $this->_phpVersion = (string) $xml->phpVersion;
        $this->_operatingSystem = (string) $xml->operatingSystem;
        $this->_serverLicenseInfo = new Jazsl_Service_Response_LicenseInfo(
            $xml->serverLicenseInfo
        );
        $this->_managerLicenseInfo = new Jazsl_Service_Response_LicenseInfo(
            $xml->managerLicenseInfo
        );
    }
    protected function _setApiVersion (SimpleXMLElement $supportedApiVersions)
    {
        return explode(',', (string) $supportedApiVersions);
    }
}