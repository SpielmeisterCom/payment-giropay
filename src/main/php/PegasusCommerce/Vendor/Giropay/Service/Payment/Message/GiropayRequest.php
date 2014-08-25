<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

abstract class GiropayRequest {
    /**
     * @var GiropayMethodType
     */
    protected $methodType;

    /**
     * @return GiropayMethodType
     */
    public function getMethodType() {
        return $this->methodType;
    }

    /**
     * @param GiropayMethodType $methodType
     */
    public function setMethodType(GiropayMethodType $methodType) {
        $this->methodType = $methodType;
    }

    public function equals(GiropayRequest $o) {
        return $this->getMethodType() == $o->getMethodType();
    }
}