<?php
class Jazsl_Response_MessageList
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
            $this->_error[] = trim((string) $error);
        }
        foreach ($xml->warning as $warning) {
            $this->_warning[] = trim((string) $warning);
        }
        foreach ($xml->info as $info) {
            $this->_info[] = trim((string) $info);
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