<?php
use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\Response;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGenerator;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGeneratorImpl;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;

class GiropayPaymentResponseGeneratorTest extends PHPUnit_Framework_TestCase {
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
        $responseGenerator->setSecret("testSecret");

        $this->responseGenerator = $responseGenerator;
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

        $response = $this->responseGenerator->buildResponse($httpResponse, $request);



        print_r($response);

    }
}