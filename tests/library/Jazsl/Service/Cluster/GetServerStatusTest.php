<?php

/**
 * Jazsl_Service_Cluster_GetServerStatus test case.
 */
class Jazsl_Service_Cluster_GetServerStatusTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Cluster_GetServerStatus
     */
    private $Jazsl_Service_Cluster_GetServerStatus;
    /**
     *
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
        $this->Jazsl_Service_Cluster_GetServerStatus =
            new Jazsl_Service_Cluster_GetServerStatus(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Auth = null;
        $this->Jazsl_Service_Cluster_GetServerStatus = null;
    }
    /**
     * Tests Jazsl_Service_Cluster_GetServerStatus->request()
     * @group GetServerStatus
     */
    public function testRequest ()
    {
        $out = $this->Jazsl_Service_Cluster_GetServerStatus->request(
            $this->Jazsl_Service_Auth
        );
        $this->assertTrue($out instanceof Jazsl_Service_Response_ServersList);
    }
}

