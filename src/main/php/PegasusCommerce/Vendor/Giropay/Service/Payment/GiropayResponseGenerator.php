<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;

interface GiropayResponseGenerator {
    /**
     * @return GiropayResponse
     */
    function buildResponse(Response $httpResponse, GiropayRequest $paymentRequest);
}