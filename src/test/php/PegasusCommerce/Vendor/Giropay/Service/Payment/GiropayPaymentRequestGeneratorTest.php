<?php
use Guzzle\Http\Client;
use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\RequestInterface;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayRequestGenerator;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayRequestGeneratorImpl;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Bankstatus\GiropayBankstatusRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusRequest;

class GiropayPaymentRequestGeneratorTest extends PHPUnit_Framework_TestCase {

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var GiropayRequestGenerator
     */
    protected $requestGenerator;

    public function setUp() {
        $this->client = new Client();

        $requestGenerator = new GiropayRequestGeneratorImpl();
        $requestGenerator->setSecret("testSecret");
        $requestGenerator->setMerchantId("1234567");
        $requestGenerator->setProjectId("1234");

        $this->requestGenerator = $requestGenerator;

    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testMissingParameter() {
        $request = $this->requestGenerator->buildRequest($this->client, new \PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest());
    }

    public function testTransactionStartRequest()
    {
        $request = new GiropayTransactionStartRequest();
        $request->setMerchantTxId(1234567890);
        $request->setAmount(100);
        $request->setCurrency("EUR");
        $request->setPurpose("Beispieltransaktion");
        $request->setBic("TESTDETT421");
        $request->setInfo1Label("Ihre Kundennummer");
        $request->setInfo1Text("0815");
        $request->setUrlRedirect("http://mydomain.de/examples/redirect.php");
        $request->setUrlNotify("http://mydomain.de/examples/notify_log.php");

        $httpRequest = $this->requestGenerator->buildRequest($this->client, $request);

        $this->assertEquals(
            RequestInterface::POST,
            $httpRequest->getMethod()
        );

        $this->assertEquals(
            "https://payment.girosolution.de/girocheckout/api/v2/transaction/start",
            $httpRequest->getUrl()
        );

        $this->assertEquals(
            $httpRequest->getPostField('hash'),
            "78ef7a9b6b145708a0bcc1f7d4acdfdf"
        );
    }


    public function testTransactionStatusRequest()
    {
        $request = new GiropayTransactionStatusRequest();
        $request->setReference('1234567890');
        $httpRequest = $this->requestGenerator->buildRequest($this->client, $request);

        $this->assertEquals(
            RequestInterface::POST,
            $httpRequest->getMethod()
        );

        $this->assertEquals(
            "https://payment.girosolution.de/girocheckout/api/v2/transaction/status",
            $httpRequest->getUrl()
        );

        $this->assertEquals(
            $httpRequest->getPostField('hash'),
            "be3341a44020021c0d6b8de95f067e28"
        );
    }

    public function testBankstatusRequest() {
        $request = new GiropayBankstatusRequest();
        $request->setBic("TESTDETT421");

        $httpRequest = $this->requestGenerator->buildRequest($this->client, $request);

        $this->assertEquals(
            RequestInterface::POST,
            $httpRequest->getMethod()
        );

        $this->assertEquals(
            "https://payment.girosolution.de/girocheckout/api/v2/giropay/bankstatus",
            $httpRequest->getUrl()
        );

        $this->assertEquals(
            $httpRequest->getPostField('hash'),
            "b6e4de587edea9f2d61bd2820f0638e4"
        );


    }
} 