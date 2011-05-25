
# Jazsl -- Just Another Zend Server Library
Based on the Zend Framework Jazsl is a simple Api Client for Zend Server and Zend Server Cluster Manager. This client library is intentionally simple, it is intended that you the consumer will extend its functionality. I do plan to add a Zend_Tool_Provider in the near future as I find the bandwidth.

It provides access to API methods:

## Todo
* Finish Unit Tests
* Complete documentation
* Add to CI Server
* Add to pear.zircote.com
* Add Zend_Tool_Provider

### Cluster Manger Methods
* clusterAddServer
  * @returns `Jazsl_Service_Response_ServerInfo`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* clusterRemoveServer
  * @returns `Jazsl_Service_Response_ServerInfo`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* clusterDisableServer
  * @returns `Jazsl_Service_Response_ServerInfo`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* clusterEnableServer
  * @returns `Jazsl_Service_Response_ServerInfo`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* clusterGetServerStatus
  * @returns `Jazsl_Service_Response_ServersList`
  * Error @returns `Jazsl_Service_Response_ErrorData`

### Generic Server Methods
* getSystemInfo
  * @returns `Jazsl_Service_Response_ServerInfo`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* restartPhp
  * @returns `Jazsl_Service_Response_ServersList`
  * Error @returns `Jazsl_Service_Response_ErrorData`

### Configuration Method
* configurationExport
  * @returns `string $filename`
  * Error @returns `Jazsl_Service_Response_ErrorData`
* configurationImport
  * @returns `Jazsl_Service_Response_ServersList`
  * Error @returns `Jazsl_Service_Response_ErrorData`
  
# Use Examples

## clusterAddServer

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Cluster_AddServer(
    'http://localhost:10081/ZendServerManager'
);
/* set required params: serverUrl, serverName and guiPassword */ 

$serverInfo = $addServer->setServerName('www-05') // required
    ->setServerUrl('https://www-05.local:10082/ZendServer') //required
    ->setGuiPassword('somepassword') // required
    ->setDoRestart('true') // defaults to false
    ->setPropagateSettings('false') // defaults to false
    ->request($auth);
/**
 * @returns Jazsl_Service_Response_ServerInfo on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
```
## clusterRemoveServer

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Cluster_RemoveServer(
    'http://localhost:10081/ZendServerManager'
);
/* set required param: serverId */ 

$serverInfo = $addServer->setServerId(3) //required
    ->request($auth);
/**
 * @returns Jazsl_Service_Response_ServerInfo on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
```

## clusterDisableServer

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Cluster_DisableServer(
    'http://localhost:10081/ZendServerManager'
);
/* set required param: serverId */ 

$serverInfo = $addServer->setServerId(3) //required
    ->request($auth);
/**
 * @returns Jazsl_Service_Response_ServerInfo on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
```

## clusterEnableServer

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Cluster_EnableServer(
    'http://localhost:10081/ZendServerManager'
);
/* set required param: serverId */ 

$serverInfo = $addServer->setServerId(3) //required
    ->request($auth);
/**
 * @returns Jazsl_Service_Response_ServerInfo on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```

## getServerStatus

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Cluster_GetServerStatus(
    'http://localhost:10081/ZendServerManager'
);

$serverInfo = $addServer->request($auth);
/**
 * @returns Jazsl_Service_Response_ServersList on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```

## restartPhp
```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Server_RestartPhp(
    'http://localhost:10081/ZendServerManager'
);

$serverInfo = $addServer->request($auth);
/**
 * @returns Jazsl_Service_Response_ServersList on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```

## getServerInfo

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Server_GetServerInfo(
    'http://localhost:10081/ZendServer'
);

$serverInfo = $addServer->request($auth);
/**
 * @returns Jazsl_Service_Response_ServerInfo on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```

## configurationExport

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Config_Export(
    'http://localhost:10081/ZendServer'
);

$serverInfo = $addServer
    ->setFilename('/tmp/zcsm-export-2010-05-23.zfcg')
    ->request($auth);
/**
 * @returns string $filename on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```

## configurationImport

```php
<?php
$auth = new Jazsl_Service_Auth();
/* assign the api credentials */
$auth->setApiKey('SomeApiKeyValue')
    ->setApiName('SomeApiKeyName');
$addServer = new Jazsl_Service_Config_Export(
    'http://localhost:10081/ZendServer'
);

$serverInfo = $addServer
    ->setFilename('/tmp/zcsm-export-2010-05-23.zfcg')
    ->setIgnoreSystemMismatch('false')
    ->request($auth);
/**
 * @returns Jazsl_Service_Response_ServersList on Success
 * @return Jazsl_Service_Response_ErrorData on Error
 */
 
```
