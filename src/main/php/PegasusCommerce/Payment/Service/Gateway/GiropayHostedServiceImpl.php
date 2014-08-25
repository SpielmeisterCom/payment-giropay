<?php
namespace PegasusCommerce\Payment\Service\Gateway;

use InvalidArgumentException;
use PegasusCommerce\Common\Payment\Dto\PaymentRequestDTO;
use PegasusCommerce\Common\Payment\Dto\PaymentResponseDTO;
use PegasusCommerce\Common\Payment\Service\PaymentGatewayHostedService;
use PegasusCommerce\Common\Vendor\Service\Monitor\ServiceStatusDetectable;
use PegasusCommerce\Core\Payment\Service\Exception\PaymentException;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;

/**
 * @Service("pcGiropayHostedService")
 */
class GiropayHostedServiceImpl implements PaymentGatewayHostedService {
    /**
     * @var GiropayConfiguration
     * @Resource(name = "pcGiropayConfiguration")
     */
    public $configuration;

    /**
     * @var ServiceStatusDetectable
     * @Resource(name = "pcGiropayPaymentServiceImpl")
     */
    public $giropayPaymentService;

    /**
     * @param PaymentRequestDTO $paymentRequestDTO
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function requestHostedEndpoint(PaymentRequestDTO $paymentRequestDTO)
    {
        $giropayRequest = new GiropayTransactionStartRequest();

        /*
         *
         * $request->setInfo1Label("Ihre Kundennummer");
         * $request->setInfo1Text("0815");
         */

        if($paymentRequestDTO->getSepaBankAccount() == null) {
            throw new InvalidArgumentException();
        }

        $giropayRequest->setMerchantTxId(1234567890);

        $giropayRequest->setPurpose($paymentRequestDTO->getOrderDescription());

        $giropayRequest->setCurrency($paymentRequestDTO->getOrderCurrencyCode());
        $giropayRequest->setAmount($paymentRequestDTO->getTransactionTotal());

        $giropayRequest->setIban($paymentRequestDTO->getSepaBankAccount()->getSepaBankAccountIBAN());
        $giropayRequest->setBic($paymentRequestDTO->getSepaBankAccount()->getSepaBankAccountBIC());

        $giropayRequest->setUrlRedirect($this->configuration->getRedirectUrl());
        $giropayRequest->setUrlNotify($this->configuration->getNotifyUrl());

        $this->giropayPaymentService->process($giropayRequest);
    }
}