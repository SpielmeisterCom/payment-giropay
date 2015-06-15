<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use GuzzleHttp\ClientInterface;
use PHPCommerce\Payment\Service\AbstractExternalPaymentGatewayCall;
use PHPCommerce\Payment\Service\Gateway\GiropayConfiguration;

class GiropayPaymentServiceImpl extends AbstractExternalPaymentGatewayCall {
    /**
     * @var GiropayConfiguration
     */
    protected $configuration;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var GiropayRequestGenerator
     */
    protected $requestGenerator;

    /**
     * @var GiropayResponseGenerator
     */
    protected $responseGenerator;

    /**
     * @return String
     */
    public function getServiceName()
    {
        return 'Giropay';
    }

    /**
     * @return GiropayConfiguration
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param GiropayConfiguration $configuration
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return ClientInterface
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * @param ClientInterface $httpClient
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return GiropayRequestGenerator
     */
    public function getRequestGenerator()
    {
        return $this->requestGenerator;
    }

    /**
     * @param GiropayRequestGenerator $requestGenerator
     */
    public function setRequestGenerator($requestGenerator)
    {
        $this->requestGenerator = $requestGenerator;
    }

    /**
     * @return GiropayResponseGenerator
     */
    public function getResponseGenerator()
    {
        return $this->responseGenerator;
    }

    /**
     * @param GiropayResponseGenerator $responseGenerator
     */
    public function setResponseGenerator($responseGenerator)
    {
        $this->responseGenerator = $responseGenerator;
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

