<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use Symfony\Component\HttpFoundation\Request;

interface GiropayResponseGenerator {
    /**
     * Builds a Giropay Response of out of a Symfony HttpRequest (for callbacks)
     * @return GiropayResponse
     * @param Request $httpRequest
     * @param Message\GiropayRequest $paymentRequest
     */
    public function buildResponseFromHttpRequest(Request $httpRequest, GiropayRequest $paymentRequest);

    /**
     * Builds a Giropay Response of out of a Guzzle HttpResponse
     * @return GiropayResponse
     * @param Response $httpResponse
     * @param Message\GiropayRequest $paymentRequest
     */
    public function buildResponseFromHttpResponse(Response $httpResponse, GiropayRequest $paymentRequest);

}