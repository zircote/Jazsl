<?php

/**
 * Jazsl_Service_Response_ErrorData test case.
 */
class Jazsl_Service_Response_ErrorDataTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Response_ErrorData
     */
    private $Jazsl_Service_Response_ErrorData;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Service_Response_ErrorData =
            new Jazsl_Service_Response_ErrorData(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Response_ErrorData = null;
    }
    /**
     * Tests Jazsl_Service_Response_ErrorData->__construct()
     */
    public function testErrorData ()
    {
        $this->markTestIncomplete("__construct test not implemented");
        $this->Jazsl_Service_Response_ErrorData;
    }
}

