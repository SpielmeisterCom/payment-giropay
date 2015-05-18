<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use GuzzleHttp\Message\Response;
use InvalidArgumentException;
use PHPCommerce\Payment\Dto\PaymentResponseDTO;
use PHPCommerce\Payment\PaymentType;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayErrorResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionNotifyResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusResponse;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayPaymentResultType;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayResultType;
use Symfony\Component\HttpFoundation\Request;

class GiropayResponseGeneratorImpl implements GiropayResponseGenerator {
    /**
     * @var String
     */
    protected $secret;

    protected function getHMACMD5Hash($secret, $data) {
        return hash_hmac('MD5', $data, $secret);
    }

    protected function verifyHttpResponseHash(Response $httpResponse) {
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
    protected function extractDataFromResponse($httpResponse, GiropayResponse $giropayResponse) {
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

            if (!array_key_exists($data["rc"], GiropayResultType::$TYPES)) {
                throw new \RuntimeException("Unknown Result Code: " . $data["rc"]);
            }

            $result = GiropayResultType::$TYPES[$data["rc"]];
            $giropayResponse->setResult($result);

            if(GiropayResultType::$OK->equals($result) && !$this->verifyHttpResponseHash($httpResponse)) {
                throw new \RuntimeException("The validation hash was invalid");
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
        $response = new GiropayTransactionStartResponse();
        $data = $this->extractDataFromResponse($httpResponse, $response);

        if(GiropayResultType::$OK->equals($response->getResult())) {
            $response->setRedirect($data["redirect"]);
            $response->setReference($data["reference"]);
        }

        return $response;
    }

    protected function buildTransactionNotifyResponse(Request $httpRequest) {
        $dataForHashValidation = "";
        foreach(array("gcReference", "gcMerchantTxId", "gcBackendTxId", "gcAmount", "gcCurrency", "gcResultPayment", "gcResultAVS") as $field) {
            $dataForHashValidation .= $httpRequest->get($field);
        }

        $hash           = $httpRequest->get("gcHash");
        $validHash      = $this->getHMACMD5Hash($this->getSecret(), $dataForHashValidation);
        if($hash != $validHash) {
            throw new \RuntimeException("The validation hash was invalid");
        }

        $response = new GiropayTransactionNotifyResponse();
        $response->setReference($httpRequest->get("gcReference"));
        $response->setMerchantTxId($httpRequest->get("gcMerchantTxId"));
        $response->setBackendTxId($httpRequest->get("gcBackendTxId"));
        $response->setAmount($httpRequest->get("gcAmount"));
        $response->setCurrency($httpRequest->get("gcCurrency"));

        if (!array_key_exists($httpRequest->get("gcResultPayment"), GiropayPaymentResultType::$TYPES)) {
            throw new \RuntimeException("Unknown Payment Result: " . $httpRequest->get("gcResultPayment"));
        }

        $paymentResult = GiropayPaymentResultType::$TYPES[$httpRequest->get("gcResultPayment")];
        $response->setPaymentResult($paymentResult);

        //$response->setResultAVS($httpRequest->get("gcResultAVS"));

        return $response;
    }

    /**
     * @param Response $httpResponse
     * @return PaymentResponseDTO
     * @throws \RuntimeException
     */
    protected function buildTransactionStatusResponse(Response $httpResponse) {
        $response = new GiropayTransactionStatusResponse();
        $data = $this->extractDataFromResponse($httpResponse, $response);

        if(GiropayResultType::$OK->equals($response->getResult())) {
            if (!array_key_exists($data["resultPayment"], GiropayPaymentResultType::$TYPES)) {
                throw new \RuntimeException("Unknown Payment Result: " . $data["resultPayment"]);
            }

            $paymentResult = GiropayPaymentResultType::$TYPES[$data["resultPayment"]];
            $response->setPaymentResult($paymentResult);

            $response->setReference($data["reference"]);
            $response->setMerchantTxId($data["merchantTxId"]);
            $response->setBackendTxId($data["backendTxId"]);
            $response->setAmount($data["amount"]);

            //$response->setResultAVS($data["resultAVS"]);
        }

        return $response;
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

    /**
     * Builds a Giropay Response of out of a Symfony HttpRequest (for callbacks)
     * @return GiropayResponse
     * @param \Symfony\Component\HttpFoundation\Request $httpRequest
     * @param Message\GiropayRequest $paymentRequest
     */
    public function buildResponseFromHttpRequest(Request $httpRequest, GiropayRequest $paymentRequest)
    {
        $giropayResponse = null;

        if(GiropayMethodType::$TRANSACTION_NOTIFY->equals($paymentRequest->getMethod())) {
            $giropayResponse = $this->buildTransactionNotifyResponse($httpRequest);
        } else {
            throw new \InvalidArgumentException("Method type not supported: " . $paymentRequest->getMethod()->getFriendlyType());
        }

        return $giropayResponse;
    }

    /**
     * Builds a Giropay Response of out of a Guzzle HttpResponse
     * @return GiropayResponse
     * @param \GuzzleHttp\Message\Response $httpResponse
     * @param Message\GiropayRequest $paymentRequest
     */
    public function buildResponseFromHttpResponse(Response $httpResponse, GiropayRequest $paymentRequest)
    {
        $giropayResponse = null;

        if( GiropayMethodType::$TRANSACTION_START->equals($paymentRequest->getMethod()) ) {
            $giropayResponse = $this->buildTransactionStartResponse($httpResponse);

        } elseif ( GiropayMethodType::$TRANSACTION_STATUS->equals($paymentRequest->getMethod()) ) {
            $giropayResponse = $this->buildTransactionStatusResponse($httpResponse);

        } else {
            throw new \InvalidArgumentException("Method type not supported: " . $paymentRequest->getMethod()->getFriendlyType());
        }

        return $giropayResponse;
    }
}