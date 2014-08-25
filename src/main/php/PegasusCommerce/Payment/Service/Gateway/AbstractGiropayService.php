<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use Guzzle\Http\ClientInterface;
use PegasusCommerce\Common\Payment\Service\AbstractExternalPaymentGatewayCall;

require_once( __DIR__ . '/../../../Vendor/Giropay/Service/Payment/SDK/GiroCheckout_SDK.php' );

abstract class AbstractGiropayService extends AbstractExternalPaymentGatewayCall {
    /**
     * @var GiropayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

    /**
     * @var ClientInterface
     */
    public $httpClient;

    /**
     * @return String
     */
    public function getServiceName()
    {
        return 'Giropay';
    }



    /*
     * returns a HMAC Hash with md5 encryption by using a secret and an array
     *
     * @param String password
     * @param mixed[] data to hash
     * @return String generated hash
     */
    protected function getHMACMD5Hash($secret, $dataArray)
    {
        $dataString = implode('', $dataArray);
        return hash_hmac('MD5', $dataString, $secret);
    }

    protected function generateBasicRequest() {

    }

    /**
     * @param $paymentRequest
     * @return mixed
     * @throws Exception
     */
    public function communicateWithVendor($paymentRequest)
    {
        /** @var GiroCheckout_SDK_Request $paymentRequest */


        $paymentRequest->submit();

        if($paymentRequest->requestHasSucceeded()) {
            $paymentRequest->getResponseParam('reference');
            $paymentRequest->getResponseParam('redirect');
        }
    }

    /**
     * @return int
     */
    public function getFailureReportingThreshold()
    {
        return 1;
    }
}

