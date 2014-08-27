<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayConfigurationServiceProvider;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayHostedService;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfiguration;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfigurationServiceImpl;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Exception;

class GiropayHostedServiceIntegrationTest extends AbstractIntegrationTest {
    /**
     * @var PaymentGatewayHostedService
     */
    protected $giropayHostedService;

    public function setUp()
    {
        parent::setUp('applicationContext-integrationtest.xml');
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
     * @expectedException PegasusCommerce\Core\Payment\Service\Exception\PaymentException
     */
    public function testPaymentExceptionOnError() {
        $this->setMockResponse(
            $this->client, array('error-missing-hash.txt')
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

     }

    /*public function testBankstatus() {
        $fraudService = $this->giropayConfiguration->getFraudService();

        $requestDTO = new PaymentRequestDTO();
        $requestDTO
            ->sepaBankAccount()
            ->sepaBankAccountBIC('TESTDETT421');

        $responseDTO = $fraudService->requestPayerAuthentication($requestDTO);

    }*/
/*
    public function testHostedService() {
        $hostedService = $this->giropayConfiguration->getHostedService();

        $requestDTO = new PaymentRequestDTO();
        $responseDTO = $hostedService->requestHostedEndpoint($requestDTO);

    }*/
}