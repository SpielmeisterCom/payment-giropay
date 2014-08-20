<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use Exception;
use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayHostedService;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;

/**
 * @Service("pcGiropayHostedService")
 */
class GiropayHostedServiceImpl extends AbstractGiropayService implements PaymentGatewayHostedService {

    /**
     * @param PaymentRequestDTO $paymentRequestDTO
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function requestHostedEndpoint(PaymentRequestDTO $paymentRequestDTO)
    {
        return $this->process($paymentRequestDTO);
    }
}