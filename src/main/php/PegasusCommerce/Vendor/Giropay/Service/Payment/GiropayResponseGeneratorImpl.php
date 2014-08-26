<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\PaymentGatewayType;
use PegasusCommerce\Common\Payment\PaymentType;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayErrorResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayResponseGeneratorImpl implements GiropayResponseGenerator {

    /**
     * @param Response $httpResponse
     * @return PaymentResponseDTO
     * @throws RuntimeException
     */
    protected function buildTransactionStartResponse(Response $httpResponse) {
        $response = new PaymentResponseDTO(
            PaymentType::$BANK_ACCOUNT,
            GiropayPaymentGatewayType::$GIROPAY
        );

        $response->rawResponse(
          $httpResponse->getBody(true)
        );
        $data = $httpResponse->json();

        if(array_key_exists("rc", $data) && $data["rc"] == 0) {

        } else {
            $response = new GiropayErrorResponse();
            $response->setRc($data["rc"]);
        }

        //print_r($httpResponse->getMessage());

   //     print_r($httpResponse->getHeaders());

 //       print_r($response->getRawResponse());
//        $response->valid();

        return $response;

    }

    /**
     * @return PaymentResponseDTO
     */
    public function buildResponse(Response $httpResponse, GiropayRequest $paymentRequest)
    {
        $giropayResponse = null;

        if(GiropayMethodType::$TRANSACTION_START->equals($paymentRequest->getMethodType())) {
            $giropayResponse = $this->buildTransactionStartResponse($httpResponse);
        } else {
            throw new InvalidArgumentException("Method type not supported: " . $paymentRequest->getMethodType()->getFriendlyType());
        }

        return $giropayResponse;
    }

    public function setSecret($secret) {

    }

    /**
     * @return String
     */
    public function getSecret()
    {
        // TODO: Implement getSecret() method.
    }
}