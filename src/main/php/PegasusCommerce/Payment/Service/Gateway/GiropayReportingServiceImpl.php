<?php
/**
 * Created by IntelliJ IDEA.
 * User: julian
 * Date: 27.08.14
 * Time: 15:19
 */

namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayReportingService;
use PegasusCommerce\Common\Payment\Service\PaymentResponseDTO;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;

class GiropayReportingServiceImpl implements PaymentGatewayReportingService {

    /**
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function findDetailsByTransaction(PaymentRequestDTO $paymentRequestDTO)
    {

    }
}