<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\PaymentGatewayType;
use PegasusCommerce\Common\Payment\PaymentType;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayErrorResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayResponseGeneratorImpl implements GiropayResponseGenerator {
    /**
     * @var String
     */
    protected $secret;

    protected function getHMACMD5Hash($secret, $data) {
        return hash_hmac('MD5', $data, $secret);
    }

    protected function verifyHash(Response $httpResponse) {
        $hash           = $httpResponse->getHeader('hash');
        $responseData   = $httpResponse->getBody(true);
        $validHash      = $this->getHMACMD5Hash($this->getSecret(), $responseData);
        $isValid        = $validHash == $hash;
        return $isValid;
    }

    /**
     * @param Response $httpResponse
     * @return PaymentResponseDTO
     * @throws \RuntimeException
     */
    protected function buildTransactionStartResponse(Response $httpResponse) {
        $response = new PaymentResponseDTO(
            PaymentType::$BANK_ACCOUNT,
            GiropayPaymentGatewayType::$GIROPAY
        );

        $response->rawResponse(
          $httpResponse->getBody(true)
        );

        try {
            $data = $httpResponse->json();

            if(array_key_exists("rc", $data) && $data["rc"] == 0) {
                $hasValidHash = $this->verifyHash($httpResponse);

                if(!$hasValidHash) {
                    throw new \RuntimeException("The validation hash was invalid");
                }

                $response = new GiropayTransactionStartResponse();
                $response->setRedirect($data["redirect"]);
                $response->setReference($data["reference"]);
            } else {
                $response = new GiropayErrorResponse();
                $response->setRc($data["rc"]);
            }
        } catch(Guzzle\Common\Exception\RuntimeException $e) {
            throw new \RuntimeException("Json payload could not be parsed", 0, $e);
        }

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
        $this->secret = $secret;
    }

    /**
     * @return String
     */
    public function getSecret()
    {
        return $this->secret;
    }
}