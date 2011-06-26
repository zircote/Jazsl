<?php

/**
 * Jazsl_Server_GetSystemInfo test case.
 */
class Jazsl_Server_GetSystemInfoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jazsl_Server_GetSystemInfo
     */
    private $Jazsl_Server_GetSystemInfo;
    /**
     * Prepares the environment before running a test.
     */
    protected function setUp ()
    {
        $this->Jazsl_Auth = new Jazsl_Auth();
        $this->Jazsl_Auth
            ->setApiKey(DEFAULT_API_KEY)
            ->setApiName(DEFAULT_API_NAME);
        $this->Jazsl_Server_GetSystemInfo =
            new Jazsl_Server_GetSystemInfo(DEFAULT_ZSCM_URI);
        $this->sharedFixture = array(
            'errorData' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ErrorData.xml'
            ),
            'serverInfo' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'ServerInfo.xml'
            ),
            'systemInfo' => file_get_contents(
                TESTS_FIXTURES_DIR . DIRECTORY_SEPARATOR . 'SystemInfo.xml'
            )
        );
        $this->responseHeader = array(
            200 => "HTTP/1.1 200 OK\r\nContent-type: text/xml\r\n\r\n",
            500 => "HTTP/1.1 500 OK\r\nContent-type: text/xml\r\n\r\n",
            400 => "HTTP/1.1 400 OK\r\nContent-type: text/xml\r\n\r\n",
        );
        $this->Jazsl_Server_GetSystemInfo->getHttpClient()->setAdapter(
            new Zend_Http_Client_Adapter_Test()
        );
    }
    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown ()
    {
        $this->Jazsl_Server_GetSystemInfo = null;
        $this->Jazsl_Auth = null;
    }
    /**
     *
     * @group GetSystemInfo
     */
    public function testRequest ()
    {
        $this->Jazsl_Server_GetSystemInfo->getHttpClient()->getAdapter()->setResponse(
        $this->responseHeader[200] . $this->sharedFixture['systemInfo']);
        $out = $this->Jazsl_Server_GetSystemInfo->request(
            $this->Jazsl_Auth
        );
        $this->assertInstanceOf('Jazsl_Response_SystemInfo', $out);
        $this->assertInstanceOf('Jazsl_Response_LicenseInfo', $out->getManagerLicenseInfo());
        $this->assertInstanceOf('Jazsl_Response_LicenseInfo', $out->getServerLicenseInfo());
        $this->assertInstanceOf('Jazsl_Response_MessageList', $out->getMessageList());
        $this->assertNotEmpty($out->getEdition());
        $this->assertNotEmpty($out->getOperatingSystem());
        $this->assertNotEmpty($out->getPhpVersion());
        $this->assertNotEmpty($out->getStatus());
        $this->assertNotEmpty($out->getSupportedApiVersions());
        $this->assertArrayHasKey(0, $out->getSupportedApiVersions());
    }
}

