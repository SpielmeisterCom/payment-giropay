<?php
/**
 * Created by IntelliJ IDEA.
 * User: julian
 * Date: 22.08.14
 * Time: 17:50
 */

namespace PegasusCommerce\Payment\Service\Gateway;

use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayFraudService;
use PegasusCommerce\Common\Payment\Service\PaymentResponseDTO;

/**
 * @Service("pcGiropayFraudService")
 */
class GiropayFraudServiceImpl extends AbstractGiropayService implements PaymentGatewayFraudService {

    /**
     * Certain Gateways integrate with Visa's Verified by Visa and MasterCard's SecureCode API
     * If the buyer is enrolled in such a service, we will need to redirect the buyer's browser
     * to the ACS ( Access Control Server, eg. users' bank) for verification.
     * See: http://en.wikipedia.org/wiki/3-D_Secure
     *
     * This method is intended to retrieve a URL to the ACS from the gateway.
     *
     * @param PaymentRequestDTO $paymentRequestDTO
     * @return PaymentResponseDTO
     */
    public function requestPayerAuthentication(PaymentRequestDTO $paymentRequestDTO)
    {
        $request = new \GiroCheckout_SDK_Request("giropayBankstatus");
        $request->setSecret($this->configuration->getSecret());
        $request->addParam('merchantId', $this->configuration->getMerchantId())
            ->addParam('projectId', $this->configuration->getProjectId())
            ->addParam('bic', $paymentRequestDTO->getSepaBankAccount()->getSepaBankAccountBIC());

        $response = $this->process($request);

        /* if request was successful show customer weather paying with giropay is possible or not */
        if($request->requestHasSucceeded())
        {
            print_r($request);
            exit;
            $request->getResponseParam('rc');
            echo $request->getResponseParam('msg');
            $request->getResponseParam('bankcode');
            $request->getResponseParam('bic');
            $request->getResponseParam('bankname');
            $request->getResponseParam('giropay');
            $request->getResponseParam('giropayid');
        }

        /* if the transaction did not succeed update your local system, get the responsecode and notify the customer */
        else {
            $request->getResponseParam('rc');
            $request->getResponseParam('msg');
            echo $request->getResponseMessage($request->getResponseParam('rc'),'DE');
        }
    }
}