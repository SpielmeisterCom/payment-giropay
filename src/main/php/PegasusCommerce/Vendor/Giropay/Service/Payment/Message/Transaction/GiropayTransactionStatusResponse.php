<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayPaymentResultType;

class GiropayTransactionStatusResponse extends GiropayResponse {
    /**
     * unique GiroCheckout transaction ID
     * @var String
     */
    protected $reference;

    /**
     * payment processor transaction ID
     * @var String
     */
    protected $backendTxId;

    /**
     * if a decimal currency is used, the amount has to be in the smallest unit of value, eg. cent, penny
     * @var int
     */
    protected $amount;

    /**
     * currency
     * @var String
     */
    protected $currency;

    /**
     * payment result
     * @var GiropayPaymentResultType
     */
    protected $paymentResult;

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

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return String
     */
    public function getBackendTxId()
    {
        return $this->backendTxId;
    }

    /**
     * @param String $backendTxId
     */
    public function setBackendTxId($backendTxId)
    {
        $this->backendTxId = $backendTxId;
    }

    /**
     * @return String
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param String $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
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

    /**
     * @return GiropayPaymentResultType
     */
    public function getPaymentResult()
    {
        return $this->paymentResult;
    }

    /**
     * @param GiropayPaymentResultType $paymentResult
     */
    public function setPaymentResult(GiropayPaymentResultType $paymentResult)
    {
        $this->paymentResult = $paymentResult;
    }


} 