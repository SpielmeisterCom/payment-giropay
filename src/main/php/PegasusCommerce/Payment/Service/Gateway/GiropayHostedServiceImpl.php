<?php
namespace PegasusCommerce\Core\Payment\Service;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayHostedService;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;

class GiropayHostedServiceImpl implements PaymentGatewayHostedService {

    /**
     * @param PaymentRequestDTO $paymentRequestDTO
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function requestHostedEndpoint(PaymentRequestDTO $paymentRequestDTO)
    {
        // TODO: Implement requestHostedEndpoint() method.
    }
}