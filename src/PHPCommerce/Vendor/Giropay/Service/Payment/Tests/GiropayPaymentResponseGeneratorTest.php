<?php
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;
use PHPCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGenerator;
use PHPCommerce\Vendor\Giropay\Service\Payment\GiropayResponseGeneratorImpl;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionNotifyRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayPaymentResultType;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayResultType;

class GiropayPaymentResponseGeneratorTest extends \PHPUnit_Framework_TestCase {
    protected static $mockBasePath;

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
    }

    public function getMockResponse($path)
    {
        $mock = new Mock([
            file_get_contents( __DIR__ . "/mock-http-responses/" . $path)
        ]);

        $this->client->getEmitter()->attach($mock);
        return $this->client->get('/');
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testServerError() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('error-internal-server-error.txt');
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMissingHash() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('error-missing-hash.txt');
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);
    }


    /**
     * @expectedException \RuntimeException
     */
    public function testMalformedHash() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('error-malformed-hash.txt');
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testMalformedJson() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('error-malformed-json.txt');
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);
    }

    public function testTransactionStart() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('transaction-start.txt');

        /** @var $response GiropayTransactionStartResponse */
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);

        $this->assertInstanceOf("PHPCommerce\\Vendor\\Giropay\\Service\\Payment\\Message\\Transaction\\GiropayTransactionStartResponse", $response);
        $this->assertTrue(GiropayResultType::$OK->equals($response->getResult()));
        $this->assertEquals("https://giropay.starfinanz.de/ftg/a/go/07i2i1k00pp09xkrnro1yaqk;jsessionid=4F6EA3CD985DEE04952FC126487F4815", $response->getRedirect());
        $this->assertEquals("a07af793-3c0e-4ecb-a1f4-ede94ca2e678", $response->getReference());

    }

    public function testAuthFail() {
        $request = new GiropayTransactionStartRequest();

        $httpResponse = $this->getMockResponse('error-auth-failed.txt');

        /** @var $response GiropayTransactionStartResponse */
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);

        $this->assertInstanceOf("PHPCommerce\\Vendor\\Giropay\\Service\\Payment\\Message\\Transaction\\GiropayTransactionStartResponse", $response);
        $this->assertTrue(GiropayResultType::$AUTHENTICATION_FAILED->equals($response->getResult()));
    }

    public function testTransactionStatusSuccessfulPayment()
    {

    }


    public function testTransactionStatusNoSuccessfulPayment()
    {
        $request = new GiropayTransactionStatusRequest();

        $httpResponse = $this->getMockResponse('transaction-status-nouserinput.txt');

        /** @var $response GiropayTransactionStatusResponse */
        $response = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $request);

        $this->assertInstanceOf("PHPCommerce\\Vendor\\Giropay\\Service\\Payment\\Message\\Transaction\\GiropayTransactionStatusResponse", $response);
        $this->assertTrue(GiropayPaymentResultType::$TIMEOUT_NO_USER_INPUT->equals($response->getPaymentResult()));
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testTransactionNotifyInvalidHash() {
        $request = \Symfony\Component\HttpFoundation\Request::create(
            "https://www.host.tld/gateway/giropay/redirect?gcReference=1c16e60f-c8a6-4886-8b74-2823b2a998b9&gcMerchantTxId=1234567890&gcBackendTxId=SHZDX3SGK1&gcAmount=100&gcCurrency=EUR&gcResultPayment=4000&gcHash=XXX",
            "GET"
        );

        $response = $this->responseGenerator->buildResponseFromHttpRequest($request, new GiropayTransactionNotifyRequest());
    }

    public function testTransactionNotifySuccessfulPayment() {
        $request = \Symfony\Component\HttpFoundation\Request::create(
            "https://www.host.tld/gateway/giropay/redirect?gcReference=1c16e60f-c8a6-4886-8b74-2823b2a998b9&gcMerchantTxId=1234567890&gcBackendTxId=SHZDX3SGK1&gcAmount=100&gcCurrency=EUR&gcResultPayment=4000&gcHash=0b7d049835dcdb8f787090a0d34f52bf",
            "GET"
        );

        $response = $this->responseGenerator->buildResponseFromHttpRequest($request, new GiropayTransactionNotifyRequest());
    }

    public function testTransactionNotifyUnsuccessfulPayment() {
        $request = \Symfony\Component\HttpFoundation\Request::create(
            "https://www.host.tld/gateway/giropay/redirect?gcReference=14c85941-9a25-4baa-9422-d116c4d8b0d9&gcMerchantTxId=1234567890&gcBackendTxId=SHZD8BAHK1&gcAmount=100&gcCurrency=EUR&gcResultPayment=4502&gcHash=456748c735bd6e78bc319e0257264781",
            "GET"
        );

        $response = $this->responseGenerator->buildResponseFromHttpRequest($request, new GiropayTransactionNotifyRequest());

    }
}