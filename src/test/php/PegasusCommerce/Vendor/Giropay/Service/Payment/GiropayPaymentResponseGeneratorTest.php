<?php
use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\Response;
use Guzzle\Tests\GuzzleTestCase;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGenerator;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGeneratorImpl;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartResponse;

class GiropayPaymentResponseGeneratorTest extends GuzzleTestCase {
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var GiropayResponseGenerator
     */
    protected $responseGenerator;

    public function setUp() {
        $this->client = new Client();

        $responseGenerator = new GiropayResponseGeneratorImpl();
        $responseGenerator->setSecret("fStSrJZVfQ");

        $this->responseGenerator = $responseGenerator;
        self::setMockBasePath( __DIR__ . '/../../../../../../resources/mock-http-responses');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testServerError() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = self::getMockResponse('error-internal-server-error.txt');
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMissingHash() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = self::getMockResponse('error-missing-hash.txt');
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);
    }


    /**
     * @expectedException \RuntimeException
     */
    public function testMalformedHash() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = self::getMockResponse('error-malformed-hash.txt');
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMalformedJson() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = self::getMockResponse('error-malformed-json.txt');
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);
    }

    public function testTransactionStart() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = self::getMockResponse('transaction-start.txt');

        /** @var $response GiropayTransactionStartResponse */
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);

        $this->assertInstanceOf("PegasusCommerce\\Vendor\\Giropay\\Service\\Payment\\Message\\Transaction\\GiropayTransactionStartResponse", $response);
        $this->assertFalse($response->isError());
        $this->assertEquals("https://giropay.starfinanz.de/ftg/a/go/07i2i1k00pp09xkrnro1yaqk;jsessionid=4F6EA3CD985DEE04952FC126487F4815", $response->getRedirect());
        $this->assertEquals("a07af793-3c0e-4ecb-a1f4-ede94ca2e678", $response->getReference());

    }

    public function testAuthFail() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = Response::fromMessage(<<<EOM
HTTP/1.1 200 OK
Date: Mon, 25 Aug 2014 17:49:03 GMT
Server: Apache/2.2.22 (Ubuntu)
X-Drupal-Cache: MISS
Expires: Sun, 19 Nov 1978 05:00:00 GMT
Last-Modified: Mon, 25 Aug 2014 17:49:03 +0000
Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0
ETag: "1408988943"
Content-Length: 52
Content-Type: application/json

{"rc":5000,"msg":"Authentifizierung fehlgeschlagen"}
EOM
);
        /** @var $response GiropayTransactionStartResponse */
        $response = $this->responseGenerator->buildResponse($httpResponse, $request);

        $this->assertInstanceOf("PegasusCommerce\\Vendor\\Giropay\\Service\\Payment\\Message\\Transaction\\GiropayTransactionStartResponse", $response);
        $this->assertEquals(5000, $response->getRc());
        $this->assertTrue($response->isError());
    }
}