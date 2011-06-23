<?php

/**
 * Jazsl_Server_RestartPhp test case.
 */
class Jazsl_Server_RestartPhpTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Server_RestartPhp
     */
    private $Jazsl_Server_RestartPhp;
    /**
     *
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
            ->setApiKey(API_KEY)
            ->setApiName(API_NAME);
        $this->Jazsl_Server_RestartPhp =
            new Jazsl_Server_RestartPhp(DEFAULT_ZSCM_URI);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Server_RestartPhp = null;
        $this->Jazsl_Auth = null;
    }
    /**
     * Tests Jazsl_Server_RestartPhp->request()
     * @group RestartPhp
     */
    public function testRequest ()
    {
        $out = $this->Jazsl_Server_RestartPhp->request(
            $this->Jazsl_Auth
        );
    }
}

