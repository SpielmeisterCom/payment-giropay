<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;

class GiropayTransactionNotifyResponse extends GiropayTransactionStatusResponse {
    /**
     * merchant transaction ID
     * @var String
     */
    protected $merchantTxId;

    /**
     * @return String
     */
    public function getMerchantTxId()
    {
        return $this->merchantTxId;
    }

    /**
     * @param String $merchantTxId
     */
    public function setMerchantTxId($merchantTxId)
    {
        $this->merchantTxId = $merchantTxId;
    }
}