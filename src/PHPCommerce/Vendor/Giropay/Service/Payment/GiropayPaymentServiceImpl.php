<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use GuzzleHttp\ClientInterface;
use PHPCommerce\Payment\Service\AbstractExternalPaymentGatewayCall;
use PHPCommerce\Payment\Service\Gateway\GiropayConfiguration;

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
     * @param $giropayRequest
     * @return mixed
     * @throws Exception
     */
    public function communicateWithVendor($giropayRequest)
    {
        $httpRequest = $this->requestGenerator->buildRequest($this->httpClient, $giropayRequest);

        $httpResponse = $this->httpClient->send($httpRequest);

        $giropayResponse = $this->responseGenerator->buildResponseFromHttpResponse($httpResponse, $giropayRequest);

        return $giropayResponse;
    }

    /**
     * @return int
     */
    public function getFailureReportingThreshold()
    {
        return $this->configuration->getFailureReportingThreshold();
    }
}

