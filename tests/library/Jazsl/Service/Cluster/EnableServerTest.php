<?php

/**
 * Jazsl_Service_Cluster_EnableServer test case.
 */
class Jazsl_Service_Cluster_EnableServerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Cluster_EnableServer
     */
    private $Jazsl_Service_Cluster_EnableServer;
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
        $this->Jazsl_Service_Cluster_EnableServer =
            new Jazsl_Service_Cluster_EnableServer(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        // TODO Auto-generated Jazsl_Service_Cluster_EnableServerTest::tearDown()
        $this->Jazsl_Service_Cluster_EnableServer = null;
        $this->Jazsl_Service_Auth = null;
    }
    /**
     * Tests Jazsl_Service_Cluster_EnableServer->request()
     * @group EnableServer
     */
    public function testRequest ()
    {
        $this->markTestIncomplete("request test not implemented");
        $this->Jazsl_Service_Cluster_EnableServer->request(
            $this->Jazsl_Service_Auth
        );
    }
}

