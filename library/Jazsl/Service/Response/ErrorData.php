<?php
class Jazsl_Service_Response_ErrorData
{
    protected $_errorCode;
    protected $_errorMessage;
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
            $xml = $xml->errorData;
        }
        $this->_errorCode = (string) $xml->errorCode;
        $this->_errorMessage = (string) $xml->errorMessage;
    }
}