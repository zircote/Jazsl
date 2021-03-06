<?php

/**
 * Jazsl_Cluster_DisableServer test case.
 */
class Jazsl_Cluster_DisableServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_DisableServer
     */
    private $Jazsl_Cluster_DisableServer;
    /**
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
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Cluster_DisableServer = new Jazsl_Cluster_DisableServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Cluster_DisableServer = null;
        $this->Jazsl_Auth = null;
        parent::tearDown();
    }
    /**
     * Tests Jazsl_Cluster_DisableServer->setServer()
     */
    public function testSetServer ()
    {
        $this->markTestIncomplete();
        $this->markTestIncomplete("setServer test not implemented");
        $this->Jazsl_Cluster_DisableServer->setServer(/* parameters */);
    }
    /**
     * @group DisableServer
     * Tests Jazsl_Cluster_DisableServer->request()
     */
    public function testRequest ()
    {
        $this->markTestIncomplete();
        $this->Jazsl_Cluster_DisableServer->setServer(3);
        $this->Jazsl_Cluster_DisableServer->request(
            $this->Jazsl_Auth
        );
    }
}

