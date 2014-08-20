<?php
namespace PegasusCommerce\Core\Payment\Service;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayConfigurationServiceProvider;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfiguration;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfigurationServiceImpl;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Exception;

class GiropayTest extends PHPUnit_Framework_TestCase {
    /**
     * @var GiropayConfigurationServiceImpl
     */
    protected $giropayConfiguration;

    public function setUp()
    {
        $container = new ContainerBuilder();
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../../../../resources'));
        $loader->load('applicationContext.xml');

        /** @var PaymentGatewayConfigurationServiceProvider $paymentGatewayConfigurationServiceProvider */
        $paymentGatewayConfigurationServiceProvider = $container->get('paymentGatewayConfigurationServiceProvider');
        $configurationServices = $paymentGatewayConfigurationServiceProvider->getGatewayConfigurationServices();

        if (count($configurationServices) != 1) {
            throw new Exception("Expected that only one payment interface is configured");
        }

        $this->giropayConfiguration = $configurationServices[0];
    }

    public function testHostedService() {
        $hostedService = $this->giropayConfiguration->getHostedService();

        $requestDTO = new PaymentRequestDTO();
        $responseDTO = $hostedService->requestHostedEndpoint($requestDTO);

    }
}