<?php
namespace PegasusCommerce\Core\Payment\Service;

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

class GiropayHostedServiceTest extends AbstractIntegrationTest {
    /**
     * @var PaymentGatewayHostedService
     */
    protected $giropayHostedService;

    public function setUp()
    {
        parent::setUp();
        $this->giropayHostedService = $this->container->get("pcGiropayHostedService");
    }

    public function testRequestHostedEndpoint() {
        $requestDTO = new PaymentRequestDTO();
        $requestDTO
            ->orderCurrencyCode('EUR')
            ->orderDescription('Test')
            ->transactionTotal(100)
            ->sepaBankAccount()
            ->sepaBankAccountBIC('TESTDETT421')
            ->done();

        $this->giropayHostedService->requestHostedEndpoint($requestDTO);
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