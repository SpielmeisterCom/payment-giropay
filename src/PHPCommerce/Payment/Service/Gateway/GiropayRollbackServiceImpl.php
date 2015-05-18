<?php
namespace PHPCommerce\Payment\Service\Gateway;

use PHPCommerce\Payment\Dto\PaymentRequestDTO;
use PHPCommerce\Payment\Dto\PaymentResponseDTO;
use PHPCommerce\Payment\Service\PaymentGatewayRollbackService;
use PHPCommerce\Payment\Service\Exception\PaymentException;

/**
 * @Service("pcGiropayRollbackService")
 */
class GiropayRollbackServiceImpl implements PaymentGatewayRollbackService {
    /**
     * @param PaymentRequestDTO $transactionToBeRolledBack
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function rollbackAuthorize(PaymentRequestDTO $transactionToBeRolledBack)
    {
        // TODO: Implement rollbackAuthorize() method.
    }

    /**
     *
     * @param PaymentRequestDTO $transactionToBeRolledBack
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function rollbackCapture(PaymentRequestDTO $transactionToBeRolledBack)
    {
        // TODO: Implement rollbackCapture() method.
    }

    /**
     *
     * @param PaymentRequestDTO $transactionToBeRolledBack
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function rollbackAuthorizeAndCapture(PaymentRequestDTO $transactionToBeRolledBack)
    {
        // TODO: Implement rollbackAuthorizeAndCapture() method.
    }

    /**
     * @param PaymentRequestDTO $transactionToBeRolledBack
     * @throws PaymentException
     * @return PaymentResponseDTO
     */
    public function rollbackRefund(PaymentRequestDTO $transactionToBeRolledBack)
    {
        // TODO: Implement rollbackRefund() method.
    }
}