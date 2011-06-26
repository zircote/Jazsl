<?php
/**
 *
 * Enter description here ...
 * @author zircote
 *
 */
class Jazsl_Auth
{
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    const X_ZEND_SIGNATURE = 'X-Zend-Signature';
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    const DATE_FORMAT = 'D, d M Y H:i:s T';
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_apiKey;
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_apiName;
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_uri;
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_host;
    /**
     *
     * Enter description here ...
     * @var unknown_type
     */
    protected $_date;
    /**
     *
     * Enter description here ...
     */
    public function getDate ()
    {
        if (null === $this->_date) {
            $this->setDate();
        }
        return $this->_date;
    }
    /**
     *
     */
    public function setDate ()
    {
        $this->_date = gmdate(self::DATE_FORMAT);
        return $this;
    }
    /**
     *
     * @param Zend_Http_Client $request
     */
    public function signRequest (Zend_Http_Client $request)
    {
        $host = $request->getUri()->getHost();
        if ($request->getUri()->getPort() != '80') {
            $host .= ':' . $request->getUri()->getPort();
        }
        $this->setUri(
            $request->getUri()->getPath()
        )->setHost($host);
        if (null === $this->getApiKey()) {
            throw new Exception('apikey must be present');
        }
        if (null === $this->getApiName()) {
            throw new Exception('apiname must be present');
        }
        $string = $this->getHost() . ':' . $this->getUri() . ':' .
         $request->getHeader('user-agent') . ':' . $this->getDate();
        $request->setHeaders(
            self::X_ZEND_SIGNATURE, sprintf(
                '%s; %s', $this->getApiName(), $this->_encrypt($string)
            )
        )->setHeaders('Date', $this->getDate())
            ->setHeaders('Host', $this->getHost());
        return $request;
    }
    /**
     *
     * @param string $string
     */
    private function _encrypt ($string)
    {
        return hash_hmac('sha256', $string, $this->getApiKey());
    }
    /**
     * @return the $_apiKey
     */
    public function getApiKey ()
    {
        return $this->_apiKey;
    }
    /**
     * @return the $_apiName
     */
    public function getApiName ()
    {
        return $this->_apiName;
    }
    /**
     * @return the $_uri
     */
    public function getUri ()
    {
        return $this->_uri;
    }
    /**
     * @return the $_host
     */
    public function getHost ()
    {
        return $this->_host;
    }
    /**
     * @param field_type $_apiKey
     * @return Jazsl_Auth
     */
    public function setApiKey ($_apiKey)
    {
        $this->_apiKey = $_apiKey;
        return $this;
    }
    /**
     * @param field_type $_apiName
     * @return Jazsl_Auth
     */
    public function setApiName ($_apiName)
    {
        $this->_apiName = $_apiName;
        return $this;
    }
    /**
     * @param field_type $_uri
     * @return Jazsl_Auth
     */
    public function setUri ($_uri)
    {
        $this->_uri = $_uri;
        return $this;
    }
    /**
     * @param field_type $_host
     * @return Jazsl_Auth
     */
    public function setHost ($_host)
    {
        $this->_host = $_host;
        return $this;
    }
}