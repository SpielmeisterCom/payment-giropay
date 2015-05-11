<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayTransactionStartRequest extends GiropayRequest {
    /**
     * unique transaction id of the merchant
     * @var string(255)
     */
    protected $merchantTxId;

    /**
     * if a decimal currency is used, the amount has to be in the smallest unit of value, eg. Cent, Penny
     * @var int
     */
    protected $amount;

    /**
     * currency
     *    EUR = Euro
     * @var string(3)
     */
    protected $currency;

    /**
     * purpose
     * @var string(27)
     */
    protected $purpose;

    /**
     * BIC (8 or 11-digits), (determined by Bankstatus Widget)
     * @var string(11)
     */
    protected $bic;

    /**
     * IBAN without whitespaces
     * @var string(34)
     */
    protected $iban;

    /**
     * additional information field which is shown on the payment form (label)
     * @var string(30)
     */
    protected $info1Label;

    /**
     * additional information field which is shown on the payment form (text)
     * @var string(80)
     */
    protected $info1Text;

    /**
     * additional information field which is shown on the payment form (label)
     * @var string(30)
     */
    protected $info2Label;

    /**
     * additional information field which is shown on the payment form (text)
     * @var string(80)
     */
    protected $info2Text;

    /**
     * additional information field which is shown on the payment form (label)
     * @var string(30)
     */
    protected $info3Label;

    /**
     * additional information field which is shown on the payment form (text)
     * @var string(80)
     */
    protected $info3Text;

    /**
     * additional information field which is shown on the payment form (label)
     * @var string(30)
     */
    protected $info4Label;

    /**
     * additional information field which is shown on the payment form (text)
     * @var string(80)
     */
    protected $info4Text;

    /**
     * additional information field which is shown on the payment form (label)
     * @var string(30)
     */
    protected $info5Label;

    /**
     * additional information field which is shown on the payment form (text)
     * @var string(80)
     */
    protected $info5Text;

    /**
     * URL, where the buyer has to be sent after payment
     * @var string
     */
    protected $urlRedirect;

    /**
     * URL, where the notification has to be sent after payment
     * @var string
     */
    protected $urlNotify;

    public function __construct() {
        $this->setMethod(GiropayMethodType::$TRANSACTION_START);
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
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
    }

    /**
     * @return string
     */
    public function getInfo1Label()
    {
        return $this->info1Label;
    }

    /**
     * @param string $info1Label
     */
    public function setInfo1Label($info1Label)
    {
        $this->info1Label = $info1Label;
    }

    /**
     * @return string
     */
    public function getInfo1Text()
    {
        return $this->info1Text;
    }

    /**
     * @param string $info1Text
     */
    public function setInfo1Text($info1Text)
    {
        $this->info1Text = $info1Text;
    }

    /**
     * @return string
     */
    public function getInfo2Label()
    {
        return $this->info2Label;
    }

    /**
     * @param string $info2Label
     */
    public function setInfo2Label($info2Label)
    {
        $this->info2Label = $info2Label;
    }

    /**
     * @return string
     */
    public function getInfo2Text()
    {
        return $this->info2Text;
    }

    /**
     * @param string $info2Text
     */
    public function setInfo2Text($info2Text)
    {
        $this->info2Text = $info2Text;
    }

    /**
     * @return string
     */
    public function getInfo3Label()
    {
        return $this->info3Label;
    }

    /**
     * @param string $info3Label
     */
    public function setInfo3Label($info3Label)
    {
        $this->info3Label = $info3Label;
    }

    /**
     * @return string
     */
    public function getInfo3Text()
    {
        return $this->info3Text;
    }

    /**
     * @param string $info3Text
     */
    public function setInfo3Text($info3Text)
    {
        $this->info3Text = $info3Text;
    }

    /**
     * @return string
     */
    public function getInfo4Label()
    {
        return $this->info4Label;
    }

    /**
     * @param string $info4Label
     */
    public function setInfo4Label($info4Label)
    {
        $this->info4Label = $info4Label;
    }

    /**
     * @return string
     */
    public function getInfo4Text()
    {
        return $this->info4Text;
    }

    /**
     * @param string $info4Text
     */
    public function setInfo4Text($info4Text)
    {
        $this->info4Text = $info4Text;
    }

    /**
     * @return string
     */
    public function getInfo5Label()
    {
        return $this->info5Label;
    }

    /**
     * @param string $info5Label
     */
    public function setInfo5Label($info5Label)
    {
        $this->info5Label = $info5Label;
    }

    /**
     * @return string
     */
    public function getInfo5Text()
    {
        return $this->info5Text;
    }

    /**
     * @param string $info5Text
     */
    public function setInfo5Text($info5Text)
    {
        $this->info5Text = $info5Text;
    }

    /**
     * @return string
     */
    public function getMerchantTxId()
    {
        return $this->merchantTxId;
    }

    /**
     * @param string $merchantTxId
     */
    public function setMerchantTxId($merchantTxId)
    {
        $this->merchantTxId = $merchantTxId;
    }

    /**
     * @return string
     */
    public function getPurpose()
    {
        return $this->purpose;
    }

    /**
     * @param string $purpose
     */
    public function setPurpose($purpose)
    {
        $this->purpose = $purpose;
    }

    /**
     * @return string
     */
    public function getUrlNotify()
    {
        return $this->urlNotify;
    }

    /**
     * @param string $urlNotify
     */
    public function setUrlNotify($urlNotify)
    {
        $this->urlNotify = $urlNotify;
    }

    /**
     * @return string
     */
    public function getUrlRedirect()
    {
        return $this->urlRedirect;
    }

    /**
     * @param string $urlRedirect
     */
    public function setUrlRedirect($urlRedirect)
    {
        $this->urlRedirect = $urlRedirect;
    }
} 