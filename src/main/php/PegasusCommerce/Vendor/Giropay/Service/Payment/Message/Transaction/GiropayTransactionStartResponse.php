<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction;

use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;

class GiropayTransactionStartResponse extends GiropayResponse {
    /**
     * unique GiroCheckout transaction ID
     * @var String
     */
    protected $reference;

    /**
     * redirect URL to the buyer's online banking account
     * @var String
     */
    protected $redirect;

    /**
     * @return String
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param String $redirect
     */
    public function setRedirect($redirect)
    {
        $this->redirect = $redirect;
    }

    /**
     * @return String
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param String $reference
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }


} 