<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Service\AbstractExternalPaymentGatewayCall;

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
        require_once( __DIR__ . '/../../../Vendor/Giropay/Service/Payment/SDK/GiroCheckout_SDK.php' );

        $request = new \GiroCheckout_SDK_Request('');

        $request->setSecret($this->configuration->getSecret());

        $request->addParam('merchantId', $this->configuration->getMerchantId())
                ->addParam('projectId',  $this->configuration->getProjectId())
                ->submit();

        if($request->requestHasSucceeded()) {
            $request->getResponseParam('reference');
            $request->getResponseParam('redirect');
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

