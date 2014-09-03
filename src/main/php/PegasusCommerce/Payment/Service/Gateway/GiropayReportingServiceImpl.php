<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\PaymentType;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayReportingService;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayConstants;
use PegasusCommerce\Vendor\Giropay\Service\Payment\GiropayPaymentGatewayType;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusRequest;

class GiropayReportingServiceImpl implements PaymentGatewayReportingService {
    /**
     * @var GiropayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

    /**
     * @var ServiceStatusDetectable
     * @Resource(name = "pcGiropayPaymentServiceImpl")
     */
    public $giropayPaymentService;

    /**
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function findDetailsByTransaction(PaymentRequestDTO $paymentRequestDTO)
    {
        $giropayRequest = new GiropayTransactionStatusRequest();

        $additionalFields = $paymentRequestDTO->getAdditionalFields();

        if(!array_key_exists(GiropayConstants::GATEWAY_TRANSACTION_ID, $additionalFields)) {
            throw new InvalidArgumentException("Missing GATEWAY_TRANSACTION_ID parameter");
        }

        $giropayRequest->setReference( $additionalFields[ GiropayConstants::GATEWAY_TRANSACTION_ID ] );

        try {
            $giropayResponse = $this->giropayPaymentService->process($giropayRequest);
            /** @var GiropayTransactionStatusResponse $giropayResponse */

            if($giropayResponse->isError()) {
                throw new PaymentException($giropayResponse->getRc().": ".$giropayResponse->getMsg());
            }

        } catch (\Exception $e) {
            throw new PaymentException("Could not query status for payment: " . $e->getMessage(), 0, $e);
        }

        $responseDTO = new PaymentResponseDTO(PaymentType::$THIRD_PARTY_ACCOUNT, GiropayPaymentGatewayType::$GIROPAY);
       /* $responseDTO
            ->responseMap(GiropayConstants::HOSTED_REDIRECT_URL, $giropayResponse->getRedirect())
            ->responseMap(GiropayConstants::GATEWAY_TRANSACTION_ID, $giropayResponse->getReference()
            );*/

        return $responseDTO;
    }
}