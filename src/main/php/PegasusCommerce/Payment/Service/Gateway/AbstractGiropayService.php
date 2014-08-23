<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Service\AbstractExternalPaymentGatewayCall;

require_once( __DIR__ . '/../../../Vendor/Giropay/Service/Payment/SDK/GiroCheckout_SDK.php' );

abstract class AbstractGiropayService extends AbstractExternalPaymentGatewayCall {
    /**
     * @var GiropayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

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

