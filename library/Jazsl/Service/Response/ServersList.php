<?php
/**
 *
 * @author zircote
 *
 */
class Jazsl_Service_Response_ServersList implements IteratorAggregate
{
    /**
     *
     * @var (Jazsl_Service_Response_ServerInfo)
     */
    protected $_serversList = array();
    /**
     *
     * @param unknown_type $xml
     */
    public function __construct ($xml)
    {
        if (! $xml instanceof SimpleXMLElement) {
            $xml = simplexml_load_string($xml);
        }
        foreach ($xml->responseData->serversList->serverInfo as $server) {
            $_server = new Jazsl_Service_Response_ServerInfo($server);
            $this->_serversList[$_server->getId()] = $_server;
        }
    }
    /**
     * @return the $_serversList
     */
    public function getServersList ()
    {
        return $this->_serversList;
    }
    /**
     * (non-PHPdoc)
     * @see IteratorAggregate::getIterator()
     */
    public function getIterator ()
    {
        return new ArrayIterator($this->_serversList);
    }
}