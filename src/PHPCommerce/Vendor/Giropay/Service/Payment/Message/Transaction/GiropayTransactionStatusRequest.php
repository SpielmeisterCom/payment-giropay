<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayTransactionStatusRequest extends GiropayRequest {
    /**
     * @var String
     */
    protected $reference;

    public function __construct() {
        $this->setMethod(GiropayMethodType::$TRANSACTION_STATUS);
    }

    /**
     * @return String
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param String $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }
} 