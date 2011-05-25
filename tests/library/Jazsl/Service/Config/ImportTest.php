<?php

/**
 * Jazsl_Service_Config_Import test case.
 */
class Jazsl_Service_Config_ImportTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Config_Import
     */
    private $Jazsl_Service_Config_Import;
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
            ->setApiKey(API_KEY)
            ->setApiName(API_NAME);
        $this->Jazsl_Service_Config_Import =
            new Jazsl_Service_Config_Import(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Config_Import = null;
        $this->Jazsl_Service_Auth = null;
    }
    /**
     * Tests Jazsl_Service_Config_Import->request()
     * @group ConfigImport
     */
    public function testRequest ()
    {
        $this->markTestSkipped('deferred for later improvements to this test.');
        $this->Jazsl_Service_Config_Import->setFilename(
            'ZendServerConfig-20110525.zcfg'
        );
        $result = $this->Jazsl_Service_Config_Import->request(
            $this->Jazsl_Service_Auth
        );
    }
}

