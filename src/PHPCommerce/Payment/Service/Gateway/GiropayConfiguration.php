<?php
namespace PHPCommerce\Payment\Service\Gateway;

use PHPCommerce\Payment\PaymentGatewayType;
use PHPCommerce\Payment\Service\failureReportingThreshold;
use PHPCommerce\Payment\Service\PaymentGatewayConfiguration;
use PHPCommerce\Vendor\Giropay\Service\Payment\GiropayPaymentGatewayType;

interface GiropayConfiguration extends PaymentGatewayConfiguration {
    /**
     * @return String
     */
    public function getSecret();

    /**
     * @return String
     */
    public function getMerchantId();

    /**
     * @return String
     */
    public function getProjectId();

    /**
     * @return String
     */
    public function getNotifyUrl();

    /**
     * @return String
     */
    public function getRedirectUrl();
}