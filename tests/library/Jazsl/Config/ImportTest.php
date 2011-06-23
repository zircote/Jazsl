<?php

/**
 * Jazsl_Config_Import test case.
 */
class Jazsl_Config_ImportTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Config_Import
     */
    private $Jazsl_Config_Import;
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
            ->setApiKey(API_KEY)
            ->setApiName(API_NAME);
        $this->Jazsl_Config_Import =
            new Jazsl_Config_Import(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Config_Import = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Tests Jazsl_Config_Import->request()
     * @group ConfigImport
     */
    public function testRequest ()
    {
        $this->markTestSkipped('deferred for later improvements to this test.');
        $this->Jazsl_Config_Import->setFilename(
            'ZendServerConfig-20110525.zcfg'
        );
        $result = $this->Jazsl_Config_Import->request(
            $this->Jazsl_Auth
        );
    }
}

