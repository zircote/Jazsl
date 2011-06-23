<?php

/**
 * Jazsl_Cluster_AddServer test case.
 */
class Jazsl_Cluster_AddServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_AddServer
     */
    private $Jazsl_Cluster_AddServer;
    /**
     * @var Jazsl_Auth
     */
    private $Jazsl_Auth;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Auth = new Jazsl_Auth();
        $this->Jazsl_Auth
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Cluster_AddServer
            = new Jazsl_Cluster_AddServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Cluster_AddServer = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Tests Jazsl_Cluster_AddServer->request()
     */
    public function testRequest ()
    {
        $this->markTestIncomplete("request test not implemented");
        $this->Jazsl_Cluster_AddServer->request(
            $this->Jazsl_Auth
        );
    }
}

