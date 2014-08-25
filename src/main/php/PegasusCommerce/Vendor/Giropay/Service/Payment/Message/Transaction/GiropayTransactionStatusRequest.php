<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayTransactionStatusRequest extends GiropayRequest {
    /**
     * @var String
     */
    protected $reference;

    public function __construct() {
        $this->setMethodType(GiropayMethodType::$TRANSACTION_STATUS);
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