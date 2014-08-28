<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;

interface GiropayResponseGenerator {
    /**
     * Builds a Giropay Response of out of a Guzzle HttpResponse or Symfony HttpRequests (for callbacks)
     * @return GiropayResponse
     * @param Guzzle\Http\Message\Response|Symfony\Component\HttpFoundation\Request $httpResponseOrRequest
     * @param Message\GiropayRequest $paymentRequest
     */
    public function buildResponse($httpResponseOrRequest, GiropayRequest $paymentRequest);
}