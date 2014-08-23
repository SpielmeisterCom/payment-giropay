<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayMethodType {
    private static $TYPES;

    /**
     * @var GiropayType
     */
    public static $BANKSTATUS;

    /**
     * @var GiropayType
     */
    public static $TRANSACTION;

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

    public function equals(PaymentGatewayType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayMethodType::$BANKSTATUS   = new GiropayMethodType("Bankstatus", "Bankstatus");
GiropayMethodType::$TRANSACTION  = new GiropayMethodType("Transaction", "Transaction");
