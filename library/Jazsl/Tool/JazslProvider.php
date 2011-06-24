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
class Jazsl_Tool_JazslProvider extends Zend_Tool_Project_Provider_Abstract implements
Zend_Tool_Framework_Provider_Pretendable
{
    /**
     *
     * @var Zend_Config
     */
    protected $_config;
    public function initialize()
    {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace(array('Jazsl_'));
    }
    private function _getConfig()
    {
        return $this->_registry->getConfig()->jazsl;
    }
    protected function _getJazslAuth()
    {
        $Jazsl_Auth = new Jazsl_Auth();
        $Jazsl_Auth->setApiKey($this->_getConfig()->apikey)->setApiName($this->_getConfig()->keyname);
        return $Jazsl_Auth;
    }

    /**
     *
     * Enter description here ...
     * @return Jazsl_Response_ServersList
     */
    protected function _getServerStatus()
    {
        $Jazsl_Cluster_GetServerStatus = new Jazsl_Cluster_GetServerStatus(
            $this->_getConfig()->zcsm
        );
        return  $Jazsl_Cluster_GetServerStatus->request($this->_getJazslAuth());
    }
    public function getServers()
    {
        ob_start();
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        $serversList = $this->_getServerStatus();
        if($serversList instanceof Jazsl_Response_ServersList){
            foreach ($serversList->getServersList() as $server) {
                /* @var $uri Zend_Uri_Http */
                $uri = $server->getAddress(true);
                $servers[] = $uri->getHost();
            }
            $json = Zend_Json::encode($servers);
        } else {
            /* @var $serversList Jazsl_Response_ErrorData */
            $json = '/* ' . $serversList->getErrorMessage() . ' */';
        }
        ob_clean();
        echo $json;
        exit;
    }
    public function getServer()
    {
        ob_start();
        $serversList = $this->_getServerStatus();
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        if($serversList instanceof Jazsl_Response_ServersList){
            foreach ($serversList->getServersList() as $server) {
                /* @var $uri Zend_Uri_Http */
                $uri = $server->getAddress(true);
                $servers[] = $uri->getHost();
                break;
            }
            $json = Zend_Json::encode($servers);
        } else {
            /* @var $serversList Jazsl_Response_ErrorData */
            $json = '/* ' . $serversList->getErrorMessage() . ' */';
        }
        echo $json;
        ob_clean();
        echo $json;
        exit;
    }

    public function clusterStatus()
    {
        ob_start();
        $serversList = $this->_getServerStatus();
        $this->_getServerListTable($serversList);
    }

    protected function _getServerListTable($serversList)
    {
        $servers = array();
        $table = new Zend_Text_Table(
            array('columnWidths' => array(10, 15, 15,60))
        );
        $table->appendRow(
            array('Server ID','Status','Instance-Name','URI')
        );
        /* @var Jazsl_Response_ServerInfo $server */
        if($serversList instanceof Jazsl_Response_ServersList){
            foreach ($serversList->getServersList() as $server) {
                /* @var $uri Zend_Uri_Http */
                $uri = $server->getAddress(true);
                $table->appendRow(
                    array(
                        $server->getId(),
                        $server->getStatus(),
                        $server->getName(),
                        (string)$uri->getHost()
                    )
                );
            }
        } else {
            /* @var $serversList Jazsl_Response_ErrorData */
            $this->_registry->getResponse()
                ->appendContent(
                    $serversList->getErrorMessage(), array('color' => 'red')
                );
        }
        $this->_registry->getResponse()->appendContent(
            'Cluster Members:', array('color' => 'cyan')
        );
        $this->_registry->getResponse()->appendContent(
            (string)$table, array('color' => 'green')
        );
    }
    public function restartPhp($serverID = null, $parallelRestart = false)
    {
        $restart = new Jazsl_Server_RestartPhp($this->_getConfig()->zcsm);
        if($serverID){
            $restart->setServers(array($serverID));
        } elseif($parallelRestart){
            $restart->setParallelRestart(true);
        }
        $serversList = $restart->request($this->_getJazslAuth());
        $this->_getServerListTable($serversList);
    }
}