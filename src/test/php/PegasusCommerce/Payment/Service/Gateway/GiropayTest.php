<?php
namespace PegasusCommerce\Core\Payment\Service;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Exception;

class GiropayTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $container   = new ContainerBuilder();
        $loader      = new XmlFileLoader($container, new FileLocator( __DIR__ . '/../../../../../resources'));
        $loader->load( 'applicationContext.xml');

        $this->paymentGatewayConfigurationServiceProvider = $container->get('paymentGatewayConfigurationServiceProvider');

        if(count($this->paymentGatewayConfigurationServiceProvider) != 1) {
            throw new Exception("Expected that only one payment interface is configured");
        }
    }

    public function testAlwaysPass() {
        $this->assertTrue(true);
    }
}