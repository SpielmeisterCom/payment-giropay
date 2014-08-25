<?php
namespace PegasusCommerce\Core\Payment\Service;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

abstract class AbstractIntegrationTest extends PHPUnit_Framework_TestCase {
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var GiropayConfigurationServiceImpl
     */
    protected $giropayConfiguration;

    public function setUp()
    {
        $container = new ContainerBuilder();
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../../../../resources'));
        $loader->load('applicationContext-test.xml');

        /** @var PaymentGatewayConfigurationServiceProvider $paymentGatewayConfigurationServiceProvider */
        $paymentGatewayConfigurationServiceProvider = $container->get('paymentGatewayConfigurationServiceProvider');
        $configurationServices = $paymentGatewayConfigurationServiceProvider->getGatewayConfigurationServices();

        if (count($configurationServices) != 1) {
            throw new Exception("Expected that only one payment interface is configured");
        }

        $this->giropayConfiguration = $configurationServices[0];
        $this->container = $container;
    }
} 