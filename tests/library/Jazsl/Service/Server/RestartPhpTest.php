<?php

/**
 * Jazsl_Service_Server_RestartPhp test case.
 */
class Jazsl_Service_Server_RestartPhpTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Server_RestartPhp
     */
    private $Jazsl_Service_Server_RestartPhp;
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
        parent::setUp();
        $this->Jazsl_Service_Auth = new Jazsl_Service_Auth();
        $this->Jazsl_Service_Auth
            ->setApiKey(API_KEY)
            ->setApiName(API_NAME);
        $this->Jazsl_Service_Server_RestartPhp =
            new Jazsl_Service_Server_RestartPhp(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Server_RestartPhp = null;
        $this->Jazsl_Service_Auth = null;
    }
    /**
     * Tests Jazsl_Service_Server_RestartPhp->request()
     * @group RestartPhp
     */
    public function testRequest ()
    {
        $out = $this->Jazsl_Service_Server_RestartPhp->request(
            $this->Jazsl_Service_Auth
        );
    }
}

