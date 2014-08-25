<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Bankstatus;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayBankstatusRequest extends GiropayRequest {
    /**
     * @var String
     */
    protected $bic;

    public function __construct() {
        $this->setMethodType(GiropayMethodType::$BANKSTATUS);
    }

    /**
     * @return String
     */
    public function getBic() {
        return $this->bic;
    }

    public function setBic($bic)
    {
        $this->bic = $bic;
    }
} 