<?php
namespace PegasusCommerce\Core\Payment\Service;

class GiropayTest extends PHPUnit_Framework_TestCase {
    public function setUp() {
        $container   = new ContainerBuilder();
        $loader      = new XmlFileLoader($container, new FileLocator( __DIR__ . '/../../../../../resources'));
        $loader->load( 'applicationContext.xml');

        $this->paymentGatewayConfigurationServiceProvider = $container->get('paymentGatewayConfigurationServiceProvider');
    }
}