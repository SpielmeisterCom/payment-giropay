<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayResultType;

abstract class GiropayResponse {
    /**
     * @var GiropayResultType
     */
    protected $result;

    /**
     * @var String
     */
    protected $rawResponse;

    /**
     * @return GiropayResultType
     */
    public function getResult()
    {
        return $this->resultCode;
    }

    /**
     * @param GiropayResultType $resultCode
     */
    public function setResult(GiropayResultType $resultCode)
    {
        $this->resultCode = $resultCode;
    }

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