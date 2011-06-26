<?php

/**
 * Jazsl_Cluster_GetServerStatus test case.
 */
class Jazsl_Cluster_GetServerStatusTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Cluster_GetServerStatus
     */
    private $Jazsl_Cluster_GetServerStatus;
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
        $this->Jazsl_Auth = new Jazsl_Auth();
        $this->Jazsl_Auth
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Cluster_GetServerStatus =
            new Jazsl_Cluster_GetServerStatus(DEFAULT_ZSCM_URI);
        $this->sharedFixture = array(
            'errorData' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ErrorData.xml'
            ),
            'serverInfo' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ServerInfo.xml'
            ),
            'systemInfo' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'SystemInfo.xml'
            ),
            'serversList' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ServersList.xml'
            )
        );
        $this->responseHeader = array(
            200 => "HTTP/1.1 200 OK\r\nContent-type: text/xml\r\n\r\n",
            500 => "HTTP/1.1 500 OK\r\nContent-type: text/xml\r\n\r\n",
            400 => "HTTP/1.1 400 OK\r\nContent-type: text/xml\r\n\r\n",
        );
        $this->Jazsl_Cluster_GetServerStatus->getHttpClient()->setAdapter(
            new Zend_Http_Client_Adapter_Test()
        );
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Auth = null;
        $this->Jazsl_Cluster_GetServerStatus = null;
    }
    /**
     * Tests Jazsl_Cluster_GetServerStatus->request()
     * @group GetServerStatus
     */
    public function testRequest ()
    {
        $this->Jazsl_Cluster_GetServerStatus->getHttpClient()->getAdapter()->setResponse(
        $this->responseHeader[200] . $this->sharedFixture['serversList']);
        $out = $this->Jazsl_Cluster_GetServerStatus->request(
            $this->Jazsl_Auth
        );
        $out = $this->Jazsl_Cluster_GetServerStatus->request(
            $this->Jazsl_Auth
        );
        $this->assertInstanceOf('Jazsl_Response_ServersList', $out);
        foreach ($out as $id => $server) {
        	/* @var $server Jazsl_Response_ServerInfo */
            $this->assertEquals($id, $server->getId());
            $this->assertNotEmpty($server->getStatus());
            $this->assertNotEmpty($server->getAddress());
            $this->assertInstanceOf('Zend_Uri_Http', $server->getAddress(true));
            $this->assertNotEmpty($server->getName());
            $this->assertInstanceOf('Jazsl_Response_MessageList', $server->getMessageList());
        }
    }
}

