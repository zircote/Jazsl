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
        $this->sharedFixture = array(
            'errorData' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ErrorData.xml'
            ),
            'serverInfo' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ServerInfo.xml'
            )
        );
        $this->responseHeader = array(
            200 => "HTTP/1.1 200 OK\r\nContent-type: text/xml\r\n\r\n",
            500 => "HTTP/1.1 500 OK\r\nContent-type: text/xml\r\n\r\n",
            400 => "HTTP/1.1 400 OK\r\nContent-type: text/xml\r\n\r\n",
        );
        $this->Jazsl_Server_RestartPhp->getHttpClient()->setAdapter(
            new Zend_Http_Client_Adapter_Test()
        );
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Server_RestartPhp = null;
        $this->Jazsl_Auth = null;
        $this->sharedFixture = null;
    }
    /**
     * Tests Jazsl_Server_RestartPhp->request()
     * @group RestartPhp
     */
    public function testRequest ()
    {
        $this->Jazsl_Server_RestartPhp->getHttpClient()->getAdapter()->setResponse(
        $this->responseHeader[200] . $this->sharedFixture['serverInfo']);
        $out = $this->Jazsl_Server_RestartPhp->request(
            $this->Jazsl_Auth
        );
        $this->assertInstanceOf('Jazsl_Response_ServersList', $out);
        foreach ($out->getServersList() as $id => $server) {
        	/* @var $server Jazsl_Response_ServerInfo */
            $this->assertEquals($id, $server->getId());
            $this->assertEquals('restarting', $server->getStatus());
            $this->assertNotEmpty($server->getAddress());
            $this->assertInstanceOf('Zend_Uri_Http', $server->getAddress(true));
            $this->assertNotEmpty($server->getName());
            $this->assertInstanceOf('Jazsl_Response_MessageList', $server->getMessageList());
        }
    }
    /**
     * Tests Jazsl_Server_RestartPhp->request()
     * @group RestartPhp
     */
    public function testResultIterator ()
    {
        $this->Jazsl_Server_RestartPhp->getHttpClient()->getAdapter()->setResponse(
        $this->responseHeader[200] . $this->sharedFixture['serverInfo']);
        $out = $this->Jazsl_Server_RestartPhp->request(
            $this->Jazsl_Auth
        );
        $this->assertInstanceOf('Jazsl_Response_ServersList', $out);
        foreach ($out as $id => $server) {
        	/* @var $server Jazsl_Response_ServerInfo */
            $this->assertEquals($id, $server->getId());
            $this->assertEquals('restarting', $server->getStatus());
            $this->assertNotEmpty($server->getAddress());
            $this->assertInstanceOf('Zend_Uri_Http', $server->getAddress(true));
            $this->assertNotEmpty($server->getName());
            $this->assertInstanceOf('Jazsl_Response_MessageList', $server->getMessageList());
        }
    }

    /**
     * Tests Jazsl_Server_RestartPhp->request()
     * @group RestartPhp
     */
    public function testErrorRequest()
    {
        $this->Jazsl_Server_RestartPhp->getHttpClient()->getAdapter()->setResponse(
        $this->responseHeader[500] . $this->sharedFixture['errorData']);
        $out = $this->Jazsl_Server_RestartPhp->request(
            $this->Jazsl_Auth
        );
        $this->assertInstanceOf('Jazsl_Response_ErrorData', $out);
        $this->assertNotEmpty($out->getErrorCode());
        $this->assertNotEmpty($out->getErrorMessage());
    }
}

