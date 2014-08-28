<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\Message\Response;
use InvalidArgumentException;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\PaymentGatewayType;
use PegasusCommerce\Common\Payment\PaymentType;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayErrorResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartResponse;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusResponse;
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
     * @return array
     * @throws \RuntimeException
     */
    protected function extractDataFromResponse($httpResponse) {
        $response = new PaymentResponseDTO(
            PaymentType::$BANK_ACCOUNT,
            GiropayPaymentGatewayType::$GIROPAY
        );

        $response->rawResponse(
            $httpResponse->getBody(true)
        );

        try {
            $data = $httpResponse->json();

            if (!array_key_exists("rc", $data) || !is_numeric($data["rc"])) {
                throw new \RuntimeException("Missing required response parameter rc");
            }

            if ($data["rc"] == 0) {
                $hasValidHash = $this->verifyHash($httpResponse);

                if (!$hasValidHash) {
                    throw new \RuntimeException("The validation hash was invalid");
                }
            }

        } catch(Guzzle\Common\Exception\RuntimeException $e) {
            throw new \RuntimeException("Json payload could not be parsed", 0, $e);
        }

        return $data;
    }

    /**
     * @param Response $httpResponse
     * @return PaymentResponseDTO
     * @throws \RuntimeException
     */
    protected function buildTransactionStartResponse(Response $httpResponse) {
        $data = $this->extractDataFromResponse($httpResponse);

        $response = new GiropayTransactionStartResponse();
        $response->setRc($data["rc"]);

        if(!$response->isError()) {
            $response->setRedirect($data["redirect"]);
            $response->setReference($data["reference"]);
        }

        return $response;
    }

    /**
     * @param Response $httpResponse
     * @return PaymentResponseDTO
     * @throws \RuntimeException
     */
    protected function buildTransactionStatusResponse(Response $httpResponse) {
        $data = $this->extractDataFromResponse($httpResponse);

        $response = new GiropayTransactionStatusResponse();
        $response->setRc($data["rc"]);

        if(!$response->isError()) {
            $response->setReference($data["reference"]);
            $response->setMerchantTxId($data["merchantTxId"]);
            $response->setBackendTxId($data["backendTxId"]);
            $response->setAmount($data["amount"]);
            $response->setResultPayment($data["resultPayment"]);
            $response->setResultAVS($data["resultAVS"]);
        }

        return $response;
    }

    /**
     * Builds a Giropay Response of out of a Guzzle HttpResponse or Symfony HttpRequests (for callbacks)
     * @return GiropayResponse
     * @param Guzzle\Http\Message\Response|Symfony\Component\HttpFoundation\Request $httpResponseOrRequest
     * @param Message\GiropayRequest $paymentRequest
     */
/*    public function buildResponse($httpResponseOrRequest, GiropayRequest $paymentRequest)
    {
        if($httpResponseOrRequest instanceof Guzzle\Http\Message\Response) {

        } elseif($httpResponseOrRequest instanceof Symfony\Component\HttpFoundation\Request) {

        } else {
            throw new \InvalidArgumentException("Type " . get_class($httpResponseOrRequest) . " is not supported as first argument");
        }
    }
*/


    /**
     * @return PaymentResponseDTO
     */
    public function buildResponse($httpResponseOrRequest, GiropayRequest $paymentRequest)
    {
        $giropayResponse = null;

        if(GiropayMethodType::$TRANSACTION_START->equals($paymentRequest->getMethodType())) {
            $giropayResponse = $this->buildTransactionStartResponse($httpResponseOrRequest);

        } elseif (GiropayMethodType::$TRANSACTION_STATUS->equals($paymentRequest->getMethodType())) {
            $giropayResponse = $this->buildTransactionStatusResponse($httpResponseOrRequest);

        } else {
            throw new \InvalidArgumentException("Method type not supported: " . $paymentRequest->getMethodType()->getFriendlyType());
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