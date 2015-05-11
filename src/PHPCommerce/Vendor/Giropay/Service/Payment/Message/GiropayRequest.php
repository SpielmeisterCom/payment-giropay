<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment\Message;

use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

abstract class GiropayRequest {
    /**
     * @var GiropayMethodType
     */
    protected $method;

    /**
     * @return GiropayMethodType
     */
    public function getMethod() {
        return $this->method;
    }

    /**
     * @param GiropayMethodType $method
     */
    public function setMethod(GiropayMethodType $method) {
        $this->method = $method;
    }

    public function equals(GiropayRequest $o) {
        return $this->getMethod() == $o->getMethod();
    }
}