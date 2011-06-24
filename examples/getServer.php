#!/usr/bin/env php
<?php
ob_start();
defined('ZSCM_RO_API_NAME') ? null: define(
    'ZSCM_RO_API_NAME','...'
);
defined('ZSCM_RO_API_KEY')  ? null: define(
    'ZSCM_RO_API_KEY','...'
);
defined('DEFAULT_ZSCM_URI') ? null: define(
    'DEFAULT_ZSCM_URI','https://localhost:10082/ZendServerManager'
);

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
$loader->registerNamespace(array('Jazsl_'));

$Jazsl_Auth = new Jazsl_Auth();
$Jazsl_Auth->setApiKey(ZSCM_RO_API_KEY)->setApiName(ZSCM_RO_API_NAME);
$Jazsl_Cluster_GetServerStatus = new Jazsl_Cluster_GetServerStatus(
    DEFAULT_ZSCM_URI
);
$serversList = $Jazsl_Cluster_GetServerStatus->request($Jazsl_Auth);
$servers = array();
/* @var Jazsl_Response_ServerInfo $server */
if($serversList instanceof Jazsl_Response_ServerInfo){
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
ob_end_clean();

echo $json;