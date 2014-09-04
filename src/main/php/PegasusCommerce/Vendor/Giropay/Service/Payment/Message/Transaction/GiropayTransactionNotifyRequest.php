<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

/**
 * Dummy object that will be used to generate the GiropayTransactionNotifyResponse
 */
class GiropayTransactionNotifyRequest extends GiropayRequest {
    public function __construct() {
        $this->setMethod(GiropayMethodType::$TRANSACTION_NOTIFY);
    }
}