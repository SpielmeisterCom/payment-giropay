<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\ClientInterface;
use PegasusCommerce\Common\Payment\Service\AbstractExternalPaymentGatewayCall;

/**
 * @Service("pcGiropayPaymentService")
 */
class GiropayPaymentServiceImpl extends AbstractExternalPaymentGatewayCall {
    /**
     * @var GiropayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

    /**
     * @var ClientInterface
     * @Resource(name = "pcHttpClient")
     */
    public $httpClient;

    /**
     * @var GiropayRequestGenerator
     * @Resource(name = "pcGiropayRequestGenerator")
     */
    public $requestGenerator;

    /**
     * @var GiropayResponseGenerator
     * @Resource(name = "pcGiropayResponseGenerator")
     */
    public $responseGenerator;

    /**
     * @return String
     */
    public function getServiceName()
    {
        return 'Giropay';
    }


    /**
     * @param $paymentRequest
     * @return mixed
     * @throws Exception
     */
    public function communicateWithVendor($paymentRequest)
    {
        $httpRequest = $this->requestGenerator->buildRequest($this->httpClient, $paymentRequest);

        $httpResponse = $this->httpClient->send($httpRequest);

        $paymentResponseDTO = $this->responseGenerator->buildResponse($httpResponse, $paymentRequest);

        return $paymentResponseDTO;
    }

    /**
     * @return int
     */
    public function getFailureReportingThreshold()
    {
        return 1;
    }
}

