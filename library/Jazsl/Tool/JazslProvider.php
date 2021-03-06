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
class Jazsl_Tool_JazslProvider extends Jazsl_Tool_JazslProviderAbstract
{
    /**
     *
     * @param string $zendserver
     * @param string $zendserver
     * @param string $url
     * @param string $apikey
     * @param string $keyname
     * @throws Exception
     */
    public function addServerKey($zendserver, $url, $keyname, $apikey)
    {
        $uri = Zend_Uri_Http::fromString($url);
        if(!in_array($uri->getPath(), array('/ZendServer','/ZendServerManager'))
        || !$uri->valid()){
            throw new Exception(
                sprintf(
                    '[%s] does not appear to be a Zend Server or Zend Server '.
                    'Manager Url', $url
                )
            );
        }
        $_config = array(
            $zendserver => array(
                'zcsm' => $url,
                'apikey' => $apikey,
                'keyname' => $keyname
            )
        );
        $config = $this->_registry->getConfig();
        if(!$config->jazsl){
            $x = $_config;
        } else {
            $jazsl = $config->jazsl->toArray();
            $x = array_merge($jazsl, $_config);
        }
        $config->jazsl = $x;
        $config->save();
    }
    public function removeServerKey($zendserver)
    {
        $resp = $this->_registry->getClient()->promptInteractiveInput(
            sprintf(
                'Are you certain you wish to remove key [%s]? yes/no',
                $zendserver
            )
        );
        if(strtolower($resp->getContent()) != 'yes'){
            return;
        }
        $config = $this->_registry->getConfig();
        unset($config->jazsl->$zendserver);
        $config->save();
        $this->_registry->getResponse()->appendContent(
            sprintf('key [%s] was removed', $zendserver),
            array('color' => 'yellow')
        );
    }
}