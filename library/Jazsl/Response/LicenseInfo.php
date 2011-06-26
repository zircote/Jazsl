<?php
class Jazsl_Response_LicenseInfo
{
    protected $_status;
    protected $_orderNumber;
    protected $_validUntil;
    protected $_serverLimit;

    public function __construct ($xml)
    {
        $this->_status = trim((string) $xml->status);
        $this->_orderNumber = trim((string) $xml->orderNumber);
        $this->_validUntil = trim((string) $xml->validUntil);
        $this->_serverLimit = trim((string) $xml->serverLimit);
    }
    /**
     * @return the $_status
     */
    public function getStatus ()
    {
        return $this->_status;
    }

    /**
     * @return the $_orderNumber
     */
    public function getOrderNumber ()
    {
        return $this->_orderNumber;
    }

    /**
     * @return the $_validUntil
     */
    public function getValidUntil ()
    {
        return $this->_validUntil;
    }

    /**
     * @return the $_serverLimit
     */
    public function getServerLimit ()
    {
        return $this->_serverLimit;
    }

}