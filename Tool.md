
# Jazsl Tool -- Just Another Zend Server Library
The CLI interface based on Zend Framework Tool.

# Setup

    pear channel-discover pear.zfcampus.org
    pear channel-discover pear.zircote.com
    pear install zfcampus/zf
    pear install zircote/Jzasl-Alpha
    zf create config
    zf enable config.provider Jazsl_Tool_JazslProvider
    zf enable config.provider Jazsl_Tool_JazslServerProvider
    zf enable config.provider Jazsl_Tool_JazslClusterProvider
    
    php.include_path = ".:/usr/local/zend/share/pear"
    basicloader.classes.0 = "Jazsl_Tool_JazslProvider"
    basicloader.classes.1 = "Jazsl_Tool_JazslServerProvider"
    basicloader.classes.2 = "Jazsl_Tool_JazslClusterProvider"




    zf add-server-key jazsl zcsm https://10.0.0.12:10082/ZendServerManager key_full xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
    
    php.include_path = ".:/usr/local/zend/share/pear"
    basicloader.classes.0 = "Jazsl_Tool_JazslProvider"
    basicloader.classes.1 = "Jazsl_Tool_JazslServerProvider"
    basicloader.classes.2 = "Jazsl_Tool_JazslClusterProvider"
    jazsl.rmhub.zcsm = "https://10.0.0.12:10082/ZendServerManager"
    jazsl.rmhub.apikey = "xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx"
    jazsl.rmhub.keyname = "key_full"


# Jazsl

`zf add-server-key jazsl zendserver url keyname apikey`
`zendserver` the identifying name for the key-set/host
`url` the full Uri for the Zend Server originating this api-key set
`keyname` the identifying name of the api-key given in the Zend Server Admin Gui Section
`apikey` the api-key hash provided

`zf remove-server-key jazsl zendserver`
`zendserver` the identifying name for the key-set/host

# JazslServer

`zf cluster-status jazsl-server zendserver`
* `zendserver` the identifying name for the key-set/host`

`zf restart-php jazsl-server zendserver server-id parallel-restart[=false]`
* `zendserver` the identifying name for the key-set/host
* `server-id` the ordinal ID assigned to the server within the Zend Cluster Manager
* `parallel-restart` restart the cluster members in-series or parallel `true/false`

`zf system-info jazsl-server zendserver`
* `zendserver` the identifying name for the key-set/host

# JazslCluster

`zf get-servers jazsl-cluster zendserver`
* `zendserver` the identifying name for the key-set/host

`zf get-server jazsl-cluster zendserver`
* `zendserver` the identifying name for the key-set/host

`zf cluster-status jazsl-cluster zendserver`
* `zendserver` the identifying name for the key-set/host

`zf add-server jazsl-cluster zendserver name url password settings-propagate[=false] do-restart[=false]`
* `zendserver` the identifying name for the key-set/host
* `name` the shortname assigned to the server
* `url` the full URI to the Zend Server Gui
* `password` the Zend Server Gui password
* `settings-propagate` will this servers settings propagate to the entire cluster? default:`false` 
* `do-restart`perform a restart once joined? default:`false`

`zf remove-server jazsl-cluster zendserver server-id force-remove[=false]`
* `zendserver` the identifying name for the key-set/host
* `server-id` the ID assigned to the server to be removed 
* `force-remove` forcibly remove the server from the cluster? default `false`

`zf enable-server jazsl-cluster zendserver server-id`
* `zendserver` the identifying name for the key-set/host
* `server-id` the ID assigned to the server to be removed 

`zf disable-server jazsl-cluster zendserver server-id`
* `zendserver` the identifying name for the key-set/host
* `server-id` the ID assigned to the server to be removed



 