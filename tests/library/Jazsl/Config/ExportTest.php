<?php

/**
 * Jazsl_Config_Export test case.
 */
class Jazsl_Config_ExportTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Config_Export
     */
    private $Jazsl_Config_Export;
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
        $this->Jazsl_Config_Export =
            new Jazsl_Config_Export(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Config_Export = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Constructs the test case.
     * @group ConfigExport
     */
    public function testRequest ()
    {
        $this->Jazsl_Config_Export->request(
            $this->Jazsl_Auth
        );
    }
}

