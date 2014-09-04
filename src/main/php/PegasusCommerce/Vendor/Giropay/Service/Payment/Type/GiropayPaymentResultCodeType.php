<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayResultCodePaymentType {
    private static $TYPES = array();



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

    public function equals(GiropayResultCodeType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

/*
 * gcResultPayment/ resultPayment	description
4000	transaction successful
giropay
4001	transaction successful
4002	online banking account invalid
4500	Zahlungsaugang unbekannt
Lastschrift
4051	invalid bank account
Kreditkarte
4101	issuing country invalid or unknown
4102	3D-Secure or MasterCard SecureCode authorization failed
4103	validation date of card exceeded
4104	invalid or unknown card type
4105	limited-use card
4106	invalid pseudo-cardnumber
4107	card stolen, suspicious or marked to move in
PayPal
4151	invalid PayPal token
4152	post-processing necessary at PayPal
4153	change PayPal payment method
4154	PayPal-payment is not completed
Allgemein
4501	timeout / no user input
4502	user aborted
4503	duplicate transaction
4504	uspicion of manipulation or payment method temporarily blocked
4505	payment method blocked or rejected
4900	transaction rejected
 */