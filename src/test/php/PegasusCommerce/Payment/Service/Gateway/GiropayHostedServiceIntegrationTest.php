<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayConfigurationServiceProvider;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayHostedService;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfiguration;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfigurationServiceImpl;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayConstants;
use Goutte\Client;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Exception;
use Symfony\Component\DomCrawler\Crawler;

class GiropayHostedServiceIntegrationTest extends AbstractIntegrationTest {
    /**
     * @var PaymentGatewayHostedService
     */
    protected $giropayHostedService;

    public function setUp()
    {
        parent::setUp();
        $this->giropayHostedService = $this->container->get("pcGiropayHostedService");
    }

    protected function generatePaymentRequestDTO() {
        $requestDTO = new PaymentRequestDTO();
        $requestDTO
            ->orderCurrencyCode('EUR')
            ->orderDescription('Test')
            ->transactionTotal(100)
            ->sepaBankAccount()
            ->sepaBankAccountBIC('TESTDETT421')
            ->done();
        return $requestDTO;
    }

    /**
     * @dataProvider getMockHttpErrorResponses
     * @expectedException PegasusCommerce\Core\Payment\Service\Exception\PaymentException
     */
    public function testPaymentExceptionOnError($errorMock) {
        $this->setMockResponse(
            $this->client, array( $errorMock )
        );

        $requestDTO = $this->generatePaymentRequestDTO();

        $response = $this->giropayHostedService->requestHostedEndpoint($requestDTO);

    }

    public function testRequestHostedEndpoint() {
        $this->setMockResponse(
            $this->client, array('transaction-start.txt')
        );

        $requestDTO = $this->generatePaymentRequestDTO();

        $response = $this->giropayHostedService->requestHostedEndpoint($requestDTO);

        $this->assertInstanceOf("PegasusCommerce\\Common\\Payment\\Dto\\PaymentResponseDTO", $response);
        $this->assertEquals("https://giropay.starfinanz.de/ftg/a/go/07i2i1k00pp09xkrnro1yaqk;jsessionid=4F6EA3CD985DEE04952FC126487F4815", $response->getResponseMap()[GiropayConstants::HOSTED_REDIRECT_URL]);
        $this->assertEquals("a07af793-3c0e-4ecb-a1f4-ede94ca2e678", $response->getResponseMap()[GiropayConstants::GATEWAY_TRANSACTION_ID]);
    }

    /**
     * @group liveTest
     */
    public function testRequestHostedEndpointLive() {
        $requestDTO = $this->generatePaymentRequestDTO();

        $response = $this->giropayHostedService->requestHostedEndpoint($requestDTO);

        $this->assertInstanceOf("PegasusCommerce\\Common\\Payment\\Dto\\PaymentResponseDTO", $response);

        $redirectUrl = $response->getResponseMap()[GiropayConstants::HOSTED_REDIRECT_URL];

        $client = new Client();

        $crawler = $client->request('GET', $redirectUrl);

        //bank login screen, login with test data
            $this->assertEquals(200, $client->getResponse()->getStatus());
            $this->assertContains("Online-Banking: Anmelden", $client->getResponse()->__toString());

            $form = $crawler->selectButton('Sicher anmelden')->form();
            $crawler = $client->submit(
                $form,
                array(
                    'account/addition[@name=benutzerkennung]'   => 'sepatest1',
                    'ticket/pin'                                => '12345'
                )
            );
        //

        //validation screen, just click next button
            $this->assertEquals(200, $client->getResponse()->getStatus());
            $this->assertContains("Bitte w&auml;hlen Sie eine Mobilfunknummer f&uuml;r den smsTAN-Versand", $client->getResponse()->__toString());

            $form = $crawler->selectButton('weiterButton')->form();
            $crawler = $client->submit(
                $form,
                array()
            );
        //

        //tan screen, enter tan
            $this->assertEquals(200, $client->getResponse()->getStatus());
            $this->assertContains("Bitte kontrollieren Sie vor der Eingabe der TAN die per SMS versandten Auftragsdaten", $client->getResponse()->__toString());
            $form = $crawler->selectButton('absendenButton')->form();
            $crawler = $client->submit(
                $form,
                array(
                    'ticket/tan'    => '123456'
                )
            );
        //

        //success screen
            $this->assertEquals(200, $client->getResponse()->getStatus());
            $this->assertContains("Der Auftrag wurde entgegengenommen", $client->getResponse()->getContent()->__toString());
            $form = $crawler->selectButton('back2MerchantButton')->form();
            $crawler = $client->submit(
                $form,
                array()
            );
        //

        //redirect screen
            $this->assertEquals(200, $client->getResponse()->getStatus());
            $this->assertContains("Die R&uuml;cksprungadresse zum H&auml;ndler wird ermittelt", $client->getResponse()->getContent()->__toString());

            //wait until the redirect address is populated
            sleep(3);

            $client->followRedirects(false);
            $form = $crawler->selectButton('go')->form();
            $crawler = $client->submit(
                $form,
                array()
            );
            $redirectUrl = $client->getResponse()->getHeader('Location');
        //
    }

    /*public function testBankstatus() {
        $fraudService = $this->giropayConfiguration->getFraudService();

        $requestDTO = new PaymentRequestDTO();
        $requestDTO
            ->sepaBankAccount()
            ->sepaBankAccountBIC('TESTDETT421');

        $responseDTO = $fraudService->requestPayerAuthentication($requestDTO);

    }*/
}