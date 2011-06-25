<?php
require_once ('Zend/Tool/Project/Provider/Abstract.php');
require_once 'Zend/Tool/Framework/Provider/Pretendable.php';
/**
 * Jazsl_Client test case.
 * @license Copyright 2010 Robert Allen
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category   CategoryName
 * @package    Jazsl
 * @author     Robert Allen <zircote@zircote.com>
 * @copyright  2011 Robert Allen
 * @license    Copyright 2010 Robert Allen
 * @version    Release: @package_version@
 * @link       http://pear.zircote.com/
 * <code>
 * zf enable config.provider Jazsl_Tool_JazslProvider
 * zf create config
 * zf ? jazsl
 * </code>
 */
class Jazsl_Tool_JazslProviderAbstract extends Zend_Tool_Project_Provider_Abstract
implements Zend_Tool_Framework_Provider_Pretendable
{

    /**
     *
     * @var string
     */
    protected $_zendserver;
    /**
     * (non-PHPdoc)
     * @see Zend_Tool_Project_Provider_Abstract::initialize()
     */
    public function initialize ()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace(array('Jazsl_'));
    }
    /**
     * @throws Zend_Tool_Framework_Action_Exception
     * @returns Zend_Config
     */
    protected function _getConfig ()
    {
        $config = $this->_registry->getConfig()->jazsl->__get(
            $this->getZendserver()
        );
        if(!$config) {
            throw new Zend_Tool_Framework_Action_Exception(
                'Specified Api Key does not exist.'
            );
        }
        return $config;
    }
    protected function _getJazslAuth ()
    {
        $jazslAuth = new Jazsl_Auth();
        $jazslAuth->setApiKey($this->_getConfig()->apikey)
            ->setApiName($this->_getConfig()->keyname);
        return $jazslAuth;
    }
    /**
     *
     * @return Jazsl_Response_ServersList| Jazsl_Response_ErrorData
     */
    protected function _getServerStatus ()
    {
        $jazslClusterGetServerStatus = new Jazsl_Cluster_GetServerStatus(
            $this->_getConfig()->zcsm
        );
        return $jazslClusterGetServerStatus->request($this->_getJazslAuth());
    }
    /**
     *
     * @param Jazsl_Response_ServersList | Jazsl_Response_ErrorData $serversList
     */
    protected function _getFromServerList ($serversList)
    {
        if($serversList instanceof Jazsl_Response_ErrorData){
            /* @var $serversList Jazsl_Response_ErrorData */
            $this->_registry->getResponse()->appendContent(
                $serversList->getErrorMessage(), array('color' => 'red')
            );
        } else {
            /* @var Jazsl_Response_ServerInfo $server */
            if ($serversList instanceof Jazsl_Response_ServersList) {
                $servers = array();
                $table = new Zend_Text_Table(
                    array('columnWidths' => array(10, 15, 15, 60))
                );
                $table->appendRow(
                    array('Server ID', 'Status', 'Instance-Name', 'URI')
                );
                foreach ($serversList->getServersList() as $server) {
                    /* @var $uri Zend_Uri_Http */
                    $uri = $server->getAddress(true);
                    $table->appendRow(
                        array($server->getId(), $server->getStatus(),
                        $server->getName(), (string) $uri->getHost())
                    );
                }
                $this->_registry->getResponse()->appendContent(
                    'Cluster Members for key: ',
                    array('color' => 'cyan', 'separator' => false)
                );
                $this->_registry->getResponse()->appendContent(
                    $this->_getConfig()->keyname . '@'. $this->getZcsm(), array('color' => 'yellow')
                );
                $this->_registry->getResponse()->appendContent(
                    (string) $table, array('color' => 'green')
                );
            }
        }
    }
    protected function _getFromServerInfo($server)
    {
        $table = new Zend_Text_Table(
            array('columnWidths' => array(10, 15, 15, 60))
        );
        $table->appendRow(
            array('Server ID', 'Status', 'Instance-Name', 'URI')
        );
            /* @var $uri Zend_Uri_Http */
        $uri = $server->getAddress(true);
        $table->appendRow(
            array($server->getId(), $server->getStatus(),
            $server->getName(), (string) $uri->getHost())
        );
        $this->_registry->getResponse()->appendContent(
            'Server Info: ',
            array('color' => 'cyan', 'separator' => false)
        );
        $this->_registry->getResponse()->appendContent(
            $this->_getConfig()->keyname . '@'. $this->getZcsm(), array('color' => 'yellow')
        );
        $this->_registry->getResponse()->appendContent(
            (string) $table, array('color' => 'green')
        );
    }
    protected function getZcsm()
    {
        $uri = Zend_Uri_Http::fromString($this->_getConfig()->zcsm);
        return $uri->getHost();
    }
	/**
     * @return the $_serverName
     */
    protected function getZendserver ()
    {
        return $this->_zendserver;
    }

	/**
     * @param string $_serverName
     * @return Jazsl_Tool_JazslProviderAbstract
     */
    protected function setZendserver ($_zendserver)
    {
        $this->_zendserver = $_zendserver;
        return $this;
    }

}