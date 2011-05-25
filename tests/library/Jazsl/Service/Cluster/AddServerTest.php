<?php

/**
 * Jazsl_Service_Cluster_AddServer test case.
 */
class Jazsl_Service_Cluster_AddServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Cluster_AddServer
     */
    private $Jazsl_Service_Cluster_AddServer;
    /**
     * @var Jazsl_Service_Auth
     */
    private $Jazsl_Service_Auth;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Service_Auth = new Jazsl_Service_Auth();
        $this->Jazsl_Service_Auth
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Service_Cluster_AddServer
            = new Jazsl_Service_Cluster_AddServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Cluster_AddServer = null;
        $this->Jazsl_Service_Auth = null;
    }
    /**
     * Tests Jazsl_Service_Cluster_AddServer->request()
     */
    public function testRequest ()
    {
        $this->markTestIncomplete("request test not implemented");
        $this->Jazsl_Service_Cluster_AddServer->request(
            $this->Jazsl_Service_Auth
        );
    }
}

