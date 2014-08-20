<?php
namespace PegasusCommerce\Core\Payment\Service;

use PegasusCommerce\Common\Payment\PaymentGatewayType;
use PegasusCommerce\Common\Payment\Service\failureReportingThreshold;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayConfiguration;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayPaymentGatewayType;

interface GiropayGatewayConfiguration extends PaymentGatewayConfiguration {
    /**
     * @return string
     */
    public function getSecret();

    /**
     * @return string
     */
    public function getMerchantId();

    /**
     * @return string
     */
    public function getProjectId();

}