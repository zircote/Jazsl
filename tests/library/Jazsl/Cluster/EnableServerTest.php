<?php

/**
 * Jazsl_Cluster_EnableServer test case.
 */
class Jazsl_Cluster_EnableServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_EnableServer
     */
    private $Jazsl_Cluster_EnableServer;
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
        $this->Jazsl_Cluster_EnableServer =
            new Jazsl_Cluster_EnableServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated Jazsl_Cluster_EnableServerTest::tearDown()
        $this->Jazsl_Cluster_EnableServer = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Tests Jazsl_Cluster_EnableServer->request()
     * @group EnableServer
     */
    public function testRequest ()
    {
        $this->markTestIncomplete("request test not implemented");
        $this->Jazsl_Cluster_EnableServer->request(
            $this->Jazsl_Auth
        );
    }
}

