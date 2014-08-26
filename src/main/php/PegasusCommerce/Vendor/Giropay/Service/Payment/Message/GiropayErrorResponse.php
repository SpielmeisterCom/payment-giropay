<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message;

class GiropayErrorResponse extends GiropayRequest {
    static $errorCodes = array(
        0    => 'OK',

        4000 => 'transaction successful',
        4001 => 'giropay bank offline',
        4002 => 'online banking account invalid',
        4020 => 'age verification successful',
        4021 => 'age verification not possible',
        4022 => 'age verification unsuccessful',
        4051 => 'invalid bank account',
        4101 => 'issuing country invalid or unknown',
        4102 => '3-D Secure or MasterCard SecureCode authorization failed',
        4103 => 'validation date of card exceeded',
        4104 => 'invalid or unknown card type',
        4105 => 'limited-use card',
        4106 => 'invalid pseudo-cardnumber',
        4107 => 'card stolen, suspicious or marked to move in',
        4151 => 'invalid PayPal token',
        4152 => 'post-processing necessary at PayPal',
        4153 => 'change PayPal payment method',
        4154 => 'PayPal-payment is not completed',
        4500 => 'payment result unknown',
        4501 => 'timeout / no user input',
        4502 => 'user aborted',
        4503 => 'duplicate transaction',
        4504 => 'suspicion of manipulation or payment method temporarily blocked',
        4505 => 'payment method blocked or rejected',
        4900 => 'transaction rejected',

        5000 => 'authentication failed',
        5001 => 'no authorization',
        5002 => 'invalid hash',
        5003 => 'mandatory field not specified',
        5004 => 'invalid call',
        5009 => 'invalid mail',
        5010 => 'invalid language',
        5011 => 'invalid country',
        5012 => 'invalid branch',
        5013 => 'invalid shop system',
        5014 => 'invalid gender',
        5015 => 'invalid product',
        5016 => 'invalid organisation type',
        5017 => 'merchant already exist',
        5018 => 'invalid PSP',
        5019 => 'invalid credit card type',
        5020 => 'invalid merchantId',
        5021 => 'invalid projectId',
        5022 => 'invalid merchantTxId',
        5023 => 'invalid purpose',
        5024 => 'invalid bankcode',
        5025 => 'invalid bankaccount',
        5026 => 'invalid bic',
        5027 => 'invalid iban',
        5028 => 'invalid mobile',
        5029 => 'invalid pkn',
        5030 => 'invalid amount',
        5031 => 'bankcode or BIC missing',
        5032 => 'invalid mandateSequence',
        5033 => 'invalid currency',
        5034 => 'transaction does not exist',
        5040 => 'invalid info1Label',
        5041 => 'invalid info1Text',
        5042 => 'invalid info2Label',
        5043 => 'invalid info2Text',
        5044 => 'invalid info3Label',
        5045 => 'invalid info3Text',
        5046 => 'invalid info4Label',
        5047 => 'invalid info4Text',
        5048 => 'invalid info5Label',
        5049 => 'invalid info5Text',
        5050 => 'invalid recurring',
        5051 => 'invalid mandateReference',
        5052 => 'invalid mandateSignedOn',
        5053 => 'invalid mandateReceiverName',
        5054 => 'invalid issuer',
        5055 => 'invalid urlRedirect',
        5056 => 'invalid urlNotify',
        5100 => 'error from payment processor',
        5101 => 'connection problem to payment processor',
        5102 => 'pseudo-cardnumber does not exist',
        5200 => 'not accepted transaction',
        5201 => 'giropay bank offline',
        5202 => 'invalid giropay bank of sender',
        5203 => 'sender bank account blacklisted',
        5204 => 'invalid sender bank account',
        6000 => 'bankcode or BIC missing',
        6001 => 'bank unknown',
        6002 => 'bank does not support giropay',
        9999 => 'internal error',
            // old codes
        1900 => 'not accepted transaction',
        1910 => 'giropay bank offline',
        1920 => 'invalid sender bank account',
        1930 => 'sender bank account blacklisted',
        1940 => 'invalid sender bank account',
        2000 => 'timeout / no user input',
        2400 => 'online banking account invalid',
        3100 => 'user aborted',
        3900 => 'giropay bank offline'
    );

    protected $rc;

    public function getMsg() {
        $errorMsg = "unknown";

        if(array_key_exists($this->rc, self::$errorCodes)) {
            $errorMsg = self::$errorCodes[ $this->rc ];
        }

        return $errorMsg;
    }
    /**
     * @return mixed
     */
    public function getRc()
    {
        return $this->rc;
    }

    /**
     * @param mixed $rc
     */
    public function setRc($rc)
    {
        $this->rc = $rc;
    }


}