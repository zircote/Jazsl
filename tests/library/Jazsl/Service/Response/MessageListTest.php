<?php

/**
 * Jazsl_Service_Response_MessageList test case.
 */
class Jazsl_Service_Response_MessageListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Service_Response_MessageList
     */
    private $Jazsl_Service_Response_MessageList;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Service_Response_MessageList =
            new Jazsl_Service_Response_MessageList(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Service_Response_MessageList = null;
        parent::tearDown();
    }
    /**
     * Tests Jazsl_Service_Response_MessageList->__construct()
     */
    public function testMessageList ()
    {
        $this->markTestIncomplete("__construct test not implemented");
        $this->Jazsl_Service_Response_MessageList->__construct(/* parameters */);
    }
    /**
     * Tests Jazsl_Service_Response_MessageList->getError()
     */
    public function testGetError ()
    {
        $this->markTestIncomplete("getError test not implemented");
        $this->Jazsl_Service_Response_MessageList->getError(/* parameters */);
    }
    /**
     * Tests Jazsl_Service_Response_MessageList->getWarning()
     */
    public function testGetWarning ()
    {
        $this->markTestIncomplete("getWarning test not implemented");
        $this->Jazsl_Service_Response_MessageList->getWarning(/* parameters */);
    }
    /**
     * Tests Jazsl_Service_Response_MessageList->getInfo()
     */
    public function testGetInfo ()
    {
        $this->markTestIncomplete("getInfo test not implemented");
        $this->Jazsl_Service_Response_MessageList->getInfo(/* parameters */);
    }
}

