<?php
namespace PHPCommerce\Payment\Service\Gateway;

use PHPCommerce\Payment\Dto\PaymentResponseDTO;
use PHPCommerce\Payment\Service\PaymentGatewayWebResponsePrintService;
use PHPCommerce\Payment\Service\PaymentGatewayWebResponseService;
use PHPCommerce\Payment\Service\Exception\PaymentException;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Service("pcGiropayWebResponseService")
 */
class GiropayGatewayWebResponseServiceImpl implements PaymentGatewayWebResponseService {

    /**
     * @var PaymentGatewayWebResponsePrintService
     * @Resource(name = "blPaymentGatewayWebResponsePrintService")
     */
    protected $webResponsePrintService;


    /**
     * @param Request $request
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function translateWebResponse(Request $request)
    {
        $responseDTO = new PaymentResponseDTO(PaymentType::$THIRD_PARTY_ACCOUNT, GiropayPaymentGatewayType::$GIROPAY);
        $responseDTO->rawResponse($this->webResponsePrintService->printRequest($request));


        // TODO: Implement requestHostedEndpoint() method.
    }
}