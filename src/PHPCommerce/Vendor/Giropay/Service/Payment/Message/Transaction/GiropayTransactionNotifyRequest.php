<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

/**
 * Dummy object that will be used to generate the GiropayTransactionNotifyResponse
 */
class GiropayTransactionNotifyRequest extends GiropayRequest {
    public function __construct() {
        $this->setMethod(GiropayMethodType::$TRANSACTION_NOTIFY);
    }
}