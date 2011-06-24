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

    public function getServers()
    {
        $Jazsl_Cluster_GetServerStatus = new Jazsl_Cluster_GetServerStatus(
            $this->_getConfig()->zcsm
        );
        $serversList = $Jazsl_Cluster_GetServerStatus->request($this->_getJazslAuth());
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        if($serversList instanceof Jazsl_Response_ServersList){
            foreach ($serversList->getServersList() as $server) {
                print_r($server);
                /* @var $uri Zend_Uri_Http */
                $uri = $server->getAddress(true);
                $servers[] = $uri->getHost();
            }
            $json = Zend_Json::encode($servers);
        } else {
            /* @var $serversList Jazsl_Response_ErrorData */
            $json = '/* ' . $serversList->getErrorMessage() . ' */';
        }
        echo $json;
    }
    public function getServer()
    {
        $Jazsl_Cluster_GetServerStatus = new Jazsl_Cluster_GetServerStatus(
            $this->_getConfig()->zcsm
        );
        $serversList = $Jazsl_Cluster_GetServerStatus->request($this->_getJazslAuth());
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        if($serversList instanceof Jazsl_Response_ServersList){
            foreach ($serversList->getServersList() as $server) {
                /* @var $uri Zend_Uri_Http */
                $uri = $server->getAddress(true);
                $servers = $uri->getHost();
                break;
            }
            $json = Zend_Json::encode($servers);
        } else {
            /* @var $serversList Jazsl_Response_ErrorData */
            $json = '/* ' . $serversList->getErrorMessage() . ' */';
        }
        echo $json;
    }


}