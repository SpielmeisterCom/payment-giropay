<?php
namespace PHPCommerce\PaymentGiropayBundle\Controller;

class GiropayController {
    /**
     * This is the url where the buyer will be sent after the payment was processed
     */
    public function redirectAction() {
        echo "REDIRECT FOR GIROPAY";
        exit;
    }

    /**
     * This endpoint will receive the notification after the payment has been processed
     */
    public function notifyAction() {
        echo "NOTIFY FOR GIROPAY";
        exit;
    }
}