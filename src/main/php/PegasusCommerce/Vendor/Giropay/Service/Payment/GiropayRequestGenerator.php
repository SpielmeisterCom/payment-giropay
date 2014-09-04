<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;

interface GiropayRequestGenerator {
    /**
     * @param ClientInterface $client
     * @param GiropayRequest $giropayRequest
     * @return EntityEnclosingRequestInterface
     */
    public function buildRequest(ClientInterface $client, GiropayRequest $giropayRequest);
}