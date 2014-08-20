<?php
use PegasusCommerce\Common\Payment\PaymentGatewayType;

class GiropayPaymentGatewayType extends PaymentGatewayType {
    /**
     * @var PaymentGatewayType
     */
    public static $GIROPAY;
}

GiropayPaymentGatewayType::$GIROPAY = new PaymentGatewayType("Giropay", "Giropay");