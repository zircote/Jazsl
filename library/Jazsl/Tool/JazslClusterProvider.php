<?php
require_once ('Jazsl/Tool/JazslProviderAbstract.php');
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
class Jazsl_Tool_JazslClusterProvider extends Jazsl_Tool_JazslProviderAbstract
{
    /**
     * returns a JSON formatted string of server names
     * <code>
     * zf get-servers jazsl
     * </code>
     */
    public function getServers ($zendserver)
    {
        $this->setZendserver($zendserver);
        ob_start();
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        $serversList = $this->_getServerStatus();
        if ($serversList instanceof Jazsl_Response_ServersList) {
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
        exit();
    }
    /**
     * returns a JSON formatted string of a single server name
     * <code>
     * zf get-server jazsl
     * </code>
     */
    public function getServer ($zendserver)
    {
        $this->setZendserver($zendserver);
        ob_start();
        $serversList = $this->_getServerStatus();
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        if ($serversList instanceof Jazsl_Response_ServersList) {
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
        exit();
    }
    /**
     * returns a table of all cluster members:
     * │Server ID │Status         │Instance-Name  │URI            |
     * <code>
     * zf cluster-status jazsl
     * </code>
     */
    public function clusterStatus($zendserver)
    {
        $this->setZendserver($zendserver);
        $serversList = $this->_getServerStatus();
        $this->_getServerListTable($serversList);
    }
    public function addServer($zendserver)
    {
        $this->setZendserver($zendserver);

    }
    public function removeServer($zendserver)
    {
        $this->setZendserver($zendserver);

    }
    public function enableServer($zendserver)
    {
        $this->setZendserver($zendserver);

    }
    public function disableServer($zendserver)
    {
        $this->setZendserver($zendserver);

    }
}