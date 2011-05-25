<?php

/**
 * Jazsl_Service_Server_GetSystemInfo test case.
 */
class Jazsl_Service_Server_GetSystemInfoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Server_GetSystemInfo
     */
    private $Jazsl_Service_Server_GetSystemInfo;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Service_Auth = new Jazsl_Service_Auth();
        $this->Jazsl_Service_Auth
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Service_Server_GetSystemInfo =
            new Jazsl_Service_Server_GetSystemInfo(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Server_GetSystemInfo = null;
        $this->Jazsl_Service_Auth = null;
    }
    /**
     * Tests Jazsl_Service_Server_GetSystemInfo->request()
     */
    public function testRequest ()
    {
        $this->markTestIncomplete("request test not implemented");
        $this->Jazsl_Service_Server_GetSystemInfo->request(
            $this->Jazsl_Service_Auth
        );
    }
}

