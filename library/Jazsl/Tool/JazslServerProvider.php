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
class Jazsl_Tool_JazslServerProvider extends Jazsl_Tool_JazslProviderAbstract
{
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
    protected function _getServerListTable ($serversList)
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
                        $server->getName(), ($uri instanceof Zend_Uri_Http) ?
                        (string) $uri->getHost() : $uri)
                    );
                }
                $this->_registry->getResponse()->appendContent(
                    'Cluster Members:', array('color' => 'cyan')
                );
                $this->_registry->getResponse()->appendContent(
                    (string) $table, array('color' => 'green')
                );
            }
        }
    }
    /**
     * returns a table of all cluster members:
     * │Server ID │Status         │Instance-Name  │URI            |
     * <code>
     * zf cluster-status jazsl
     * </code>
     */
    public function clusterStatus ($zendserver)
    {
        $this->setZendserver($zendserver);
        $serversList = $this->_getServerStatus();
        $this->_getServerListTable($serversList);
    }
    /**
     * parallelRestart: how the servers will be restarted parallel|series
     * serverID: int serverID to restart, no value specified will restart all
     * returns a table of all cluster members:
     * │Server ID │Status         │Instance-Name  │URI            |
     * <code>
     * zf cluster-status jazsl
     * </code>
     * @param int|null $serverID
     * @param true|false $parallelRestart
     */
    public function restartPhp ($zendserver, $serverID = null, $parallelRestart = false)
    {
        $this->setZendserver($zendserver);
        $restart = new Jazsl_Server_RestartPhp($this->_getConfig()->zcsm);
        if ($serverID) {
            $restart->setServers(array($serverID));
        } elseif ($parallelRestart) {
            $restart->setParallelRestart(true);
        }
        $serversList = $restart->request($this->_getJazslAuth());
        $this->_getServerListTable($serversList);
    }
    /**
     * returns generals informations regarding the server queried
     * <code>
     * zf server-info jazsl
     * </code>
     */
    public function systemInfo($zendserver)
    {
        $this->setZendserver($zendserver);
        $systemInfo = new Jazsl_Server_GetSystemInfo($this->_getConfig()->zcsm);
        $serverUri = Zend_Uri_Http::fromString($this->_getConfig()->zcsm);
//        $systemInfo->setServerId();
        /* @var Jazsl_Response_SystemInfo $data */
        $data = $systemInfo->request($this->_getJazslAuth());
        if($data instanceof Jazsl_Response_ErrorData){
            $this->_registry->getResponse()->appendContent(
                'Error ['.$data->getErrorMessage().']',
                array('color' => 'red')
            );
            return;
        }
        $this->_registry->getResponse()->appendContent(
            'Server Info ['.$serverUri->getHost().']', array('color' => 'green')
        );
        $slit = new Zend_Text_Table(
            array('columnWidths' => array(10, 40, 15, 20))
        );
        $slit->appendRow(
            array('Status','Edition', 'PHP Version', 'OS')
        );
        $slit->appendRow(
            array($data->getStatus(), $data->getEdition() ,
            $data->getPhpVersion() ,$data->getOperatingSystem())
        );
        $this->_registry->getResponse()->appendContent((string)$slit);
        if($data->getSupportedApiVersions()){
            $slit = new Zend_Text_Table(
                array('columnWidths' => array(88))
            );
            $slit->appendRow(array('Supported API Version'));
            foreach ($data->getSupportedApiVersions() as $version) {
                $slit->appendRow(array($version));
            }
            $this->_registry->getResponse()->appendContent( (string) $slit);
        }
        if($lic = $data->getServerLicenseInfo()){
            $this->_registry->getResponse()->appendContent(
                'Server License Info', array('color' => 'green', 'indention' => '20')
            );
            $slit = new Zend_Text_Table(
                array('columnWidths' => array(10, 15, 40, 20))
            );
            $slit->appendRow(
                array('Status', 'Order #', 'Valid Until', 'Server Limit')
            );
            $slit->appendRow(
                array($lic->getStatus(), $lic->getOrderNumber(),
                $lic->getValidUntil(), $lic->getServerLimit())
            );
            $this->_registry->getResponse()->appendContent(
                (string) $slit
            );
        }
        if($lic =$data->getManagerLicenseInfo()){
            $this->_registry->getResponse()->appendContent(
                'Manager License Info', array('color' => 'green', 'indention' => '20')
            );
            $slit = new Zend_Text_Table(
                array('columnWidths' => array(10, 15, 40, 20))
            );
            $slit->appendRow(
                array('Status', 'Order #', 'Valid Until', 'Server Limit')
            );
            $slit->appendRow(
                array($lic->getStatus(), $lic->getOrderNumber(),
                $lic->getValidUntil(), $lic->getServerLimit())
            );
            $this->_registry->getResponse()->appendContent(
                (string) $slit
            );
        }
        if($msg = $data->getMessageList()){
            $this->_registry->getResponse()->appendContent(
                'Messages', array('color' => 'green', 'indention' => '20')
            );
            $slit = new Zend_Text_Table(
                array('columnWidths' => array(10, 15, 40, 10))
            );
            $slit->appendRow(
                array('Status', 'Order #', 'Valid Until', 'Server Limit')
            );
            $slit->appendRow(
                array($lic->getStatus(), $lic->getOrderNumber(),
                $lic->getValidUntil(), $lic->getServerLimit())
            );
        }
    }
}