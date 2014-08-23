<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message;

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
     * @param GiropayRequest $methodType
     */
    public function setMethodType(GiropayRequest $methodType) {
        $this->methodType = $methodType;
    }

    public function equals(GiropayRequest $o) {
        return $this->getMethodType() == $o->getMethodType();
    }
}