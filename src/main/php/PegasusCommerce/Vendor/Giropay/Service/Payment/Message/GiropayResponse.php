<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message;

abstract class GiropayResponse {
    /**
     * @var String
     */
    protected $rawResponse;

    /**
     * @return String
     */
    public function getRawResponse() {
        return $this->rawResponse;
    }

    /**
     * @param $rawResponse
     */
    public function setRawResponse($rawResponse) {
        $this->rawResponse = $rawResponse;
    }

    public function equals(GiropayResponse $o) {
        return $this->getRawResponse() == $o->getRawResponse();
    }
}