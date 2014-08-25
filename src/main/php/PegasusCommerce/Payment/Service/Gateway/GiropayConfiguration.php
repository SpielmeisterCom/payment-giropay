<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\PaymentGatewayType;
use PegasusCommerce\Common\Payment\Service\failureReportingThreshold;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayConfiguration;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayPaymentGatewayType;

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