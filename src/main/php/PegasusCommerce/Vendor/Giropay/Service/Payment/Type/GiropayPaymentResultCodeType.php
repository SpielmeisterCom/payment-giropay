<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayPaymentResultCodeType {
    private static $TYPES = array();

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $TRANSACTION_SUCCESSFUL;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $GIROPAY_TRANSACTION_SUCCESSFUL;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $GIROPAY_ONLINE_BANKING_ACCOUNT_INVALID;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $GIROPAY_PAYMENT_RESULT_UNKNOWN;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $TIMEOUT_NO_USER_INPUT;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $USER_ABORTED;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $DUPLICATE_TRANSACTION;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $MANIPULATION_OR_TEMPORARILY_BLOCKED;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $PAYMENT_METHOD_BLOCKED_OR_REJECTED;

    /**
     * @var GiropayPaymentResultCodeType
     */
    public static $TRANSACTION_REJECTED;

    public function __construct($type = null, $friendlyType = null) {
        if ($friendlyType) {
            $this->friendlyType = $friendlyType;
        }

        if ($type) {
            $this->setType($type);
        }
    }

    public function getType() {
        return $this->type;
    }

    public function getFriendlyType() {
        return $this->friendlyType;
    }

    private function setType($type) {
        $this->type = $type;

        if (!array_key_exists($type, self::$TYPES)) {
            self::$TYPES[$type] = $this;
        }
    }

    public function equals(GiropayPaymentResultCodeType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayPaymentResultCodeType::$TRANSACTION_SUCCESSFUL                  = new GiropayResultCodeType(4000, "transaction successful");
GiropayPaymentResultCodeType::$GIROPAY_TRANSACTION_SUCCESSFUL          = new GiropayResultCodeType(4001, "giropay transaction successful");
GiropayPaymentResultCodeType::$GIROPAY_ONLINE_BANKING_ACCOUNT_INVALID  = new GiropayResultCodeType(4002, "giropay online banking account invalid");
GiropayPaymentResultCodeType::$GIROPAY_PAYMENT_RESULT_UNKNOWN          = new GiropayResultCodeType(4500, "giropay payment result unknown");
GiropayPaymentResultCodeType::$TIMEOUT_NO_USER_INPUT                   = new GiropayResultCodeType(4501, "timeout / no user input");
GiropayPaymentResultCodeType::$USER_ABORTED                            = new GiropayResultCodeType(4502, "user aborted");
GiropayPaymentResultCodeType::$DUPLICATE_TRANSACTION                   = new GiropayResultCodeType(4503, "duplicate transaction");
GiropayPaymentResultCodeType::$MANIPULATION_OR_TEMPORARILY_BLOCKED     = new GiropayResultCodeType(4504, "suspicion of manipulation or payment method temporarily blocked");
GiropayPaymentResultCodeType::$PAYMENT_METHOD_BLOCKED_OR_REJECTED      = new GiropayResultCodeType(4505, "payment method blocked or rejected");
GiropayPaymentResultCodeType::$TRANSACTION_REJECTED                    = new GiropayResultCodeType(4900, "transaction rejected");
