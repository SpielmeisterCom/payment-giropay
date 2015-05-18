<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use PHPCommerce\Payment\PaymentGatewayType;

class GiropayPaymentGatewayType extends PaymentGatewayType {
    /**
     * @var PaymentGatewayType
     */
    public static $GIROPAY;
}

GiropayPaymentGatewayType::$GIROPAY = new PaymentGatewayType("Giropay", "Giropay");