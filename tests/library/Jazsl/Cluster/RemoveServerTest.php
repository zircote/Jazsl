<?php

/**
 * Jazsl_Cluster_RemoveServer test case.
 */
class Jazsl_Cluster_RemoveServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_RemoveServer
     */
    private $Jazsl_Cluster_RemoveServer;
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
        $this->Jazsl_Cluster_RemoveServer =
            new Jazsl_Cluster_RemoveServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Cluster_RemoveServer = null;
        $this->Jazsl_Auth = null;
        parent::tearDown();
    }
    /**
     * Tests Jazsl_Cluster_RemoveServer->request()
     */
    public function testRequest ()
    {
        $this->markTestIncomplete();
        $this->Jazsl_Cluster_RemoveServer->request(
            $this->Jazsl_Auth
        );
    }
}

