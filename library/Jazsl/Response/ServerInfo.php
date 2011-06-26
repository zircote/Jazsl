<?php
class Jazsl_Response_ServerInfo
{
    protected $_id;
    protected $_name;
    protected $_address;
    protected $_status;
    /**
     * @var Jazsl_Response_MessageList
     */
    protected $_messageList;
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
            if ($xml->errorData) {
                return  new Jazsl_Response_ErrorData($xml->errorData);
            }
            $xml = $xml->responseData->serverInfo;
        }
        $this->_id = (string) $xml->id;
        $this->_name = trim((string) $xml->name);
        $this->_address = trim((string) $xml->address);
        $this->_status = trim((string) $xml->status);
        $this->_messageList = new Jazsl_Response_MessageList(
            $xml->messageList
        );
    }
    /**
     * @return the $_id
     */
    public function getId ()
    {
        return $this->_id;
    }
    /**
     * @return the $_name
     */
    public function getName ()
    {
        return $this->_name;
    }
    /**
     * @return the $_address
     */
    public function getAddress ($asUri = false)
    {
        if($asUri && $this->_address){
            require_once 'Zend/Uri/Http.php';
            return Zend_Uri_Http::fromString($this->_address);
        }
        return $this->_address;
    }
    /**
     * @return the $_status
     */
    public function getStatus ()
    {
        return $this->_status;
    }
    /**
     * @return the $_messageList
     */
    public function getMessageList ()
    {
        return $this->_messageList;
    }
}