<?php
/**
 *
 * @author zircote
 *
 */
class Jazsl_Config_Export extends Jazsl_RequestAbstract
{
    /**
     *
     * @var string
     */
    protected $_httpPath = '/Api/configurationExport';
    /**
     *
     * @var string
     */
    protected $_filename;
    /**
     *
     * @param array $servers
     */
    public function setFilename ($filename)
    {
        $this->_filename = $filename;
    }
    /**
     *
     * @param Jazsl_Auth $auth
     */
    public function request (Jazsl_Auth $auth)
    {
        $this->_setHeaders();
        $pattern = '/[^attachment;filename="]([A-Za-z0-9\.-]+)/';
        $auth->signRequest($this->_httpClient);
        $this->getHttpClient()->setStream();
        $this->_response = $this->getHttpClient()->request(
            Zend_Http_Client::GET
        );
        if (300 > $this->_response->getStatus()) {
            preg_match(
                $pattern,
                $this->_response->getHeader('Content-Disposition'), $match
            );
            if (null == $this->_filename) {
                $this->_filename = '.' . DIRECTORY_SEPARATOR . $match[0];
            }
            if (! file_exists($this->_filename) && ! is_writable(
                $this->_filename
            )) {
                throw new Exception('file name|location is not valid');
            }
            copy($this->_response->getStreamName(), $this->_filename);
            return $this->_filename;
        } else {
            return new Jazsl_Response_ErrorData(
                $this->_response->getBody()
            );
        }
    }
}