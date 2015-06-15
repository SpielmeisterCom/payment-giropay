<?php
namespace PHPCommerce\Payment\Service\Gateway;

use PHPCommerce\Payment\Service\CreditCardTypesExtensionHandler;
use PHPCommerce\Payment\Service\PaymentGatewayConfiguration;
use PHPCommerce\Payment\Service\PaymentGatewayConfigurationService;
use PHPCommerce\Payment\Service\PaymentGatewayCreditCardService;
use PHPCommerce\Payment\Service\PaymentGatewayCustomerService;
use PHPCommerce\Payment\Service\PaymentGatewayFieldExtensionHandler;
use PHPCommerce\Payment\Service\PaymentGatewayFraudService;
use PHPCommerce\Payment\Service\PaymentGatewayHostedService;
use PHPCommerce\Payment\Service\PaymentGatewayReportingService;
use PHPCommerce\Payment\Service\PaymentGatewayRollbackService;
use PHPCommerce\Payment\Service\PaymentGatewaySubscriptionService;
use PHPCommerce\Payment\Service\PaymentGatewayTransactionConfirmationService;
use PHPCommerce\Payment\Service\PaymentGatewayTransactionService;
use PHPCommerce\Payment\Service\PaymentGatewayTransparentRedirectService;
use PHPCommerce\Payment\Service\PaymentGatewayWebResponseService;
use PHPCommerce\Payment\Service\TRCreditCardExtensionHandler;

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
     * @param GiropayGatewayConfiguration $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @param PaymentGatewayHostedService $hostedService
     */
    public function setHostedService($hostedService)
    {
        $this->hostedService = $hostedService;
    }

    /**
     * @param PaymentGatewayHostedService $rollbackService
     */
    public function setRollbackService($rollbackService)
    {
        $this->rollbackService = $rollbackService;
    }

    /**
     * @param PaymentGatewayWebResponseService $webResponseService
     */
    public function setWebResponseService($webResponseService)
    {
        $this->webResponseService = $webResponseService;
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