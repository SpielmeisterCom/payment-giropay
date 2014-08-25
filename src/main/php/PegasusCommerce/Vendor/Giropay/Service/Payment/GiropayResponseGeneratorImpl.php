<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;

class GiropayResponseGeneratorImpl implements GiropayResponseGenerator {

    /**
     * @return PaymentResponseDTO
     */
    public function buildResponse(Response $httpResponse)
    {
        // TODO: Implement buildResponse() method.
    }
}