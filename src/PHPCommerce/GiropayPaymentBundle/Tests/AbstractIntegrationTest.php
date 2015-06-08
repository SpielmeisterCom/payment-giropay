<?php
namespace PHPCommerce\GiropayPaymentBundle\Tests;

use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

abstract class AbstractIntegrationTest extends \PHPUnit_Framework_TestCase {
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

        $loader      = new YamlFileLoader($container, new FileLocator(array(__DIR__ . "/../Resources/config")));
        $loader->load( 'giropay-integration-test.yml');

        $this->giropayConfiguration = $container->get("phpcommerce.payment.gateway.giropay.configuration");
        $this->container = $container;

        $this->client = $this->container->get("phpcommerce.http_client");
    }

    /*
    public function getMockResponse($path)
    {
        $mock = new Mock([
            file_get_contents( __DIR__ . "/mock-http-responses/" . $path)
        ]);

        $this->client->getEmitter()->attach($mock);
        return $this->client->get('/');
    }
    */

    public function getMockHttpResponsesByPrefix($prefix) {
        $path = __DIR__ . "/mock-http-responses/";

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