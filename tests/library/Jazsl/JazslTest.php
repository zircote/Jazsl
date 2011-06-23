<?php

class JazslTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_GetServerStatus
     */
    private $Jazsl_Cluster_GetServerStatus;
    /**
     *
     * @var Jazsl_Auth
     */
    private $Jazsl_Auth;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        parent::setUp();
        $this->Jazsl_Auth = new Jazsl_Auth();
        $this->Jazsl_Auth
            ->setApiKey(API_KEY)
            ->setApiName(API_NAME);
        $this->Jazsl_Cluster_GetServerStatus = new Jazsl_Cluster_GetServerStatus(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Cluster_GetServerStatus = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Tests Jazsl_Cluster_GetServerStatus->request()
     * @group JazslTest
     */
    public function testRequest ()
    {
        /* @var $out Jazsl_Response_ServersList */
        $out = $this->Jazsl_Cluster_GetServerStatus->request(
            $this->Jazsl_Auth
        );
        $servers = array();
        /* @var Jazsl_Response_ServerInfo $server */
        foreach ($out->getServersList() as $server) {
            /* @var $uri Zend_Uri_Http */
            $uri = $server->getAddress(true);
            echo $servers[] = $uri->getHost(), PHP_EOL;
            echo $server->getStatus(), PHP_EOL;
        }
        echo Zend_Json::encode($servers);
    }
}