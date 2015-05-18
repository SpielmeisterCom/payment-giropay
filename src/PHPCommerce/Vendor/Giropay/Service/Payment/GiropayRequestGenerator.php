<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;

interface GiropayRequestGenerator {
    /**
     * @param ClientInterface $client
     * @param GiropayRequest $giropayRequest
     * @return RequestInterface
     */
    public function buildRequest(ClientInterface $client, GiropayRequest $giropayRequest);
}