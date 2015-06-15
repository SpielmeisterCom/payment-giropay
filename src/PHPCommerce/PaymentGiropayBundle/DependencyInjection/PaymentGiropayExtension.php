<?php
namespace PHPCommerce\PaymentGiropayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Config\FileLocator;

class PaymentGiropayExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('giropay-vendor.yml');
        $loader->load('giropay-payment-gateway.yml');
    }

    public function getAlias()
    {
        return 'php_commerce_payment_giropay';
    }
}
