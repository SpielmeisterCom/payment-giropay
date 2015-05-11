<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayPaymentResultType {
    public static $TYPES = array();

    /**
     * @var GiropayPaymentResultType
     */
    public static $TRANSACTION_SUCCESSFUL;

    /**
     * @var GiropayPaymentResultType
     */
    public static $GIROPAY_TRANSACTION_SUCCESSFUL;

    /**
     * @var GiropayPaymentResultType
     */
    public static $GIROPAY_ONLINE_BANKING_ACCOUNT_INVALID;

    /**
     * @var GiropayPaymentResultType
     */
    public static $GIROPAY_PAYMENT_RESULT_UNKNOWN;

    /**
     * @var GiropayPaymentResultType
     */
    public static $TIMEOUT_NO_USER_INPUT;

    /**
     * @var GiropayPaymentResultType
     */
    public static $USER_ABORTED;

    /**
     * @var GiropayPaymentResultType
     */
    public static $DUPLICATE_TRANSACTION;

    /**
     * @var GiropayPaymentResultType
     */
    public static $MANIPULATION_OR_TEMPORARILY_BLOCKED;

    /**
     * @var GiropayPaymentResultType
     */
    public static $PAYMENT_METHOD_BLOCKED_OR_REJECTED;

    /**
     * @var GiropayPaymentResultType
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

    public function equals(GiropayPaymentResultType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayPaymentResultType::$TRANSACTION_SUCCESSFUL                  = new GiropayPaymentResultType("4000", "transaction successful");
GiropayPaymentResultType::$GIROPAY_TRANSACTION_SUCCESSFUL          = new GiropayPaymentResultType("4001", "giropay transaction successful");
GiropayPaymentResultType::$GIROPAY_ONLINE_BANKING_ACCOUNT_INVALID  = new GiropayPaymentResultType("4002", "giropay online banking account invalid");
GiropayPaymentResultType::$GIROPAY_PAYMENT_RESULT_UNKNOWN          = new GiropayPaymentResultType("4500", "giropay payment result unknown");
GiropayPaymentResultType::$TIMEOUT_NO_USER_INPUT                   = new GiropayPaymentResultType("4501", "timeout / no user input");
GiropayPaymentResultType::$USER_ABORTED                            = new GiropayPaymentResultType("4502", "user aborted");
GiropayPaymentResultType::$DUPLICATE_TRANSACTION                   = new GiropayPaymentResultType("4503", "duplicate transaction");
GiropayPaymentResultType::$MANIPULATION_OR_TEMPORARILY_BLOCKED     = new GiropayPaymentResultType("4504", "suspicion of manipulation or payment method temporarily blocked");
GiropayPaymentResultType::$PAYMENT_METHOD_BLOCKED_OR_REJECTED      = new GiropayPaymentResultType("4505", "payment method blocked or rejected");
GiropayPaymentResultType::$TRANSACTION_REJECTED                    = new GiropayPaymentResultType("4900", "transaction rejected");
