<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayWebResponsePrintService;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayWebResponseService;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;
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