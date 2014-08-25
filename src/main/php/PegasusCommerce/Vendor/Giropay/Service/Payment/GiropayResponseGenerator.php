<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;

interface GiropayResponseGenerator {
    /**
     * @return PaymentResponseDTO
     */
    function buildResponse(Response $httpResponse, GiropayRequest $paymentRequest);

    /**
     * @return String
     */
    function getSecret();
}