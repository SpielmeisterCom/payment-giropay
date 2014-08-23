<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Bankstatus;


class GiropayBankstatusRequest extends GiropayRequest {
    private $BIC;

    public function getBIC() {
        return $this->BIC;
    }
    public function setBIC($BIC) {
        $this->BIC = $BIC;
    }
} 