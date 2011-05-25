<?php
class Jazsl_Service_Response_MessageList
{
    protected $_error = array();
    protected $_warning = array();
    protected $_info = array();
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
        }
        foreach ($xml->error as $error) {
            $this->_error[] = (string) $error;
        }
        foreach ($xml->warning as $warning) {
            $this->_warning[] = (string) $warning;
        }
        foreach ($xml->info as $info) {
            $this->_info[] = (string) $info;
        }
    }
    /**
     * @return the $_error
     */
    public function getError ()
    {
        return $this->_error;
    }
    /**
     * @return the $_warning
     */
    public function getWarning ()
    {
        return $this->_warning;
    }
    /**
     * @return the $_info
     */
    public function getInfo ()
    {
        return $this->_info;
    }
}