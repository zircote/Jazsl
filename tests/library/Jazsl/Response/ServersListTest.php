<?php

/**
 * Jazsl_Response_ServersList test case.
 */
class Jazsl_Response_ServersListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Response_ServersList
     */
    private $Jazsl_Response_ServersList;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Response_ServersList =
            new Jazsl_Response_ServersList(/* parameters */);
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Response_ServersList = null;
    }
    /**
     * Tests Jazsl_Response_ServersList->__construct()
     */
    public function testServersList ()
    {
        $this->markTestIncomplete("__construct test not implemented");
        $this->Jazsl_Response_ServersList;
    }
    /**
     * Tests Jazsl_Response_ServersList->getServersList()
     */
    public function testGetServersList ()
    {
        $this->markTestIncomplete("getServersList test not implemented");
        $this->Jazsl_Response_ServersList
            ->getServersList(/* parameters */);
    }
    /**
     * Tests Jazsl_Response_ServersList->getIterator()
     */
    public function testGetIterator ()
    {
        $this->markTestIncomplete("getIterator test not implemented");
        $this->Jazsl_Response_ServersList
            ->getIterator(/* parameters */);
    }
}

