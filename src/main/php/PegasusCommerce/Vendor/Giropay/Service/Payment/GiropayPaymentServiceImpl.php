<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\ClientInterface;
use PegasusCommerce\Common\Payment\Service\AbstractExternalPaymentGatewayCall;
use PegasusCommerce\Payment\Service\Gateway\GiropayConfiguration;

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

        $giropayResponse = $this->responseGenerator->buildResponse($httpResponse, $giropayRequest);

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

