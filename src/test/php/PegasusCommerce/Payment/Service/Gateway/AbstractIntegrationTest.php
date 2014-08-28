<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use Guzzle\Tests\GuzzleTestCase;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

abstract class AbstractIntegrationTest extends GuzzleTestCase {
    protected $client;

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
        date_default_timezone_set('Europe/Berlin');

        $container = new ContainerBuilder();
        $container->setParameter("app.baseUrl", "https://www.abfallscout.de");

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../../../../../resources'));
        $loader->load("applicationContext-integrationtest.xml");

        /** @var PaymentGatewayConfigurationServiceProvider $paymentGatewayConfigurationServiceProvider */
        $paymentGatewayConfigurationServiceProvider = $container->get('paymentGatewayConfigurationServiceProvider');
        $configurationServices = $paymentGatewayConfigurationServiceProvider->getGatewayConfigurationServices();

        if (count($configurationServices) != 1) {
            throw new Exception("Expected that only one payment interface is configured");
        }

        $this->giropayConfiguration = $configurationServices[0];
        $this->container = $container;

        $this->client = $this->container->get("pcHttpClient");

        self::setMockBasePath( __DIR__ . '/../../../../../resources/mock-http-responses' );
    }


    public function getMockHttpResponsesByPrefix($prefix) {
        $path = __DIR__ . "/../../../../../resources/mock-http-responses/";

        $fileNames = glob( $path . $prefix . "-*");

        $fileNames = array_map( function($file) use ($path) {
            return array( str_replace($path, "", $file) );
        }, $fileNames);

        return $fileNames;
    }

    public function getMockHttpErrorResponses() {
        return $this->getMockHttpResponsesByPrefix("error");
    }

} 