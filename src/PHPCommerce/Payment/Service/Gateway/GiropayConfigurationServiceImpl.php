<?php
namespace PHPCommerce\Payment\Service\Gateway;

use PHPCommerce\Core\Payment\Service\CreditCardTypesExtensionHandler;
use PHPCommerce\Core\Payment\Service\PaymentGatewayConfiguration;
use PHPCommerce\Core\Payment\Service\PaymentGatewayConfigurationService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayCreditCardService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayCustomerService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayFieldExtensionHandler;
use PHPCommerce\Core\Payment\Service\PaymentGatewayFraudService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayHostedService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayReportingService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayRollbackService;
use PHPCommerce\Core\Payment\Service\PaymentGatewaySubscriptionService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayTransactionConfirmationService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayTransactionService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayTransparentRedirectService;
use PHPCommerce\Core\Payment\Service\PaymentGatewayWebResponseService;
use PHPCommerce\Core\Payment\Service\TRCreditCardExtensionHandler;

/**
 * @Service("pcGiropayConfigurationService")
 */
class GiropayConfigurationServiceImpl implements PaymentGatewayConfigurationService {
    /**
     * @var GiropayGatewayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

    /**
     * @var PaymentGatewayHostedService
     * @Resource(name = "pcGiropayHostedService")
     */
    public $hostedService;

    /**
     * @var PaymentGatewayHostedService
     * @Resource(name = "pcGiropayRollbackService")
     */
    public $rollbackService;

    /**
     * @var PaymentGatewayWebResponseService
     * @Resource(name = "pcGiropayWebResponseService")
     */
    public $webResponseService;


    /**
     * @return PaymentGatewayConfiguration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @return PaymentGatewayTransactionService
     */
    public function getTransactionService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayTransactionConfirmationService
     */
    public function getTransactionConfirmationService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayReportingService
     */
    public function getReportingService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayCreditCardService
     */
    public function getCreditCardService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayCustomerService
     */
    public function getCustomerService()
    {
        return null;
    }

    /**
     * @return PaymentGatewaySubscriptionService
     */
    public function getSubscriptionService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayFraudService
     */
    public function getFraudService()
    {
        return null;
    }

    /**
     * @return PaymentGatewayHostedService
     */
    public function getHostedService()
    {
        return $this->hostedService;
    }

    /**
     * @return PaymentGatewayRollbackService
     */
    public function getRollbackService()
    {
        return $this->rollbackService;
    }

    /**
     * @return PaymentGatewayWebResponseService
     */
    public function getWebResponseService()
    {
        return $this->webResponseService;
    }

    /**
     * @return PaymentGatewayTransparentRedirectService
     */
    public function getTransparentRedirectService()
    {
        return null;
    }

    /**
     * @return TRCreditCardExtensionHandler
     */
    public function getCreditCardExtensionHandler()
    {
        return null;
    }

    /**
     * @return PaymentGatewayFieldExtensionHandler
     */
    public function getFieldExtensionHandler()
    {
        return null;
    }

    /**
     * @return CreditCardTypesExtensionHandler
     */
    public function getCreditCardTypesExtensionHandler()
    {
        return null;
    }
}