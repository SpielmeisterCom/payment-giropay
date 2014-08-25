<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment;

use Guzzle\Http\ClientInterface;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\RequestInterface;
use InvalidArgumentException;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusRequest;
use PegasusCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

class GiropayRequestGeneratorImpl implements GiropayRequestGenerator {
    /**
     * @var String
     */
    protected $secret;

    /**
     * @var String
     */
    protected $merchantId;

    /**
     * @var String
     */
    protected $projectId;

    /*
     * returns a HMAC Hash with md5 encryption by using a secret and an array
     *
     * @param String password
     * @param mixed[] data to hash
     * @return String generated hash
     */
    protected function getHMACMD5Hash($secret, $data)
    {
        return hash_hmac('MD5', $data, $secret);
    }

    /**
     * @param ClientInterface $client
     * @param GiropayTransactionStartRequest $giropayRequest
     * @return EntityEnclosingRequestInterface
     */
    protected function buildTransactionStartRequest(ClientInterface $client, GiropayTransactionStartRequest $giropayRequest) {
        $requestArray = array();
        $requestArray['merchantId']     = $this->getMerchantId();
        $requestArray['projectId']      = $this->getProjectId();

        if($giropayRequest->getMerchantTxId() == "") {
            throw new InvalidArgumentException("Field merchantTxId is required");
        }
        $requestArray['merchantTxId']   = $giropayRequest->getMerchantTxId();

        if($giropayRequest->getAmount() == "") {
            throw new InvalidArgumentException("Field amount is required");
        }
        $requestArray['amount']         = $giropayRequest->getAmount();

        if($giropayRequest->getCurrency() == "") {
            throw new InvalidArgumentException("Field currency is required");
        }
        $requestArray['currency']       = $giropayRequest->getCurrency();

        if($giropayRequest->getPurpose() == "") {
            throw new InvalidArgumentException("Field purpose is required");
        }
        $requestArray['purpose']        = $giropayRequest->getPurpose();

        if($giropayRequest->getBic() == "") {
            throw new InvalidArgumentException("Field bic is required");
        }
        $requestArray['bic']            = $giropayRequest->getBic();

        if($giropayRequest->getIban() != "") {
            $requestArray['iban']           = $giropayRequest->getIban();
        }

        if($giropayRequest->getInfo1Label() != "" || $giropayRequest->getInfo1Text() != "") {
            $requestArray['info1Label'] = $giropayRequest->getInfo1Label();
            $requestArray['info1Text']  = $giropayRequest->getInfo1Text();
        }

        if($giropayRequest->getInfo2Label() != "" || $giropayRequest->getInfo2Text() != "") {
            $requestArray['info2Label'] = $giropayRequest->getInfo2Label();
            $requestArray['info2Text']  = $giropayRequest->getInfo2Text();
        }

        if($giropayRequest->getInfo3Label() != "" || $giropayRequest->getInfo3Text() != "") {
            $requestArray['info3Label'] = $giropayRequest->getInfo3Label();
            $requestArray['info3Text']  = $giropayRequest->getInfo3Text();
        }

        if($giropayRequest->getInfo4Label() != "" || $giropayRequest->getInfo4Text() != "") {
            $requestArray['info4Label'] = $giropayRequest->getInfo4Label();
            $requestArray['info4Text']  = $giropayRequest->getInfo4Text();
        }

        if($giropayRequest->getInfo5Label() != "" || $giropayRequest->getInfo5Text() != "") {
            $requestArray['info5Label'] = $giropayRequest->getInfo5Label();
            $requestArray['info5Text']  = $giropayRequest->getInfo5Text();
        }

        $requestArray['urlRedirect']    = $giropayRequest->getUrlRedirect();
        $requestArray['urlNotify']      = $giropayRequest->getUrlNotify();

        //this works because the hash list in PHP has a sort order (we get the values out in the order we added them)
        $sortedValuesString             = implode('', array_values($requestArray));

        $requestArray['hash']           = $this->getHMACMD5Hash($this->getSecret(), $sortedValuesString);

        $request = $client->post(
            "https://payment.girosolution.de/girocheckout/api/v2/transaction/start",
            array(),
            $requestArray
        );

        return $request;
    }

    /**
     * @param ClientInterface $client
     * @param GiropayRequest $giropayRequest
     * @return EntityEnclosingRequestInterface
     */
    public function buildRequest(ClientInterface $client, GiropayRequest $giropayRequest)
    {
        $request = null;

        if(GiropayMethodType::$TRANSACTION_START->equals($giropayRequest->getMethodType())) {
            return $this->buildTransactionStartRequest($client, $giropayRequest);
        } else {
            throw new InvalidArgumentException("Method type not supported: " . $giropayRequest->getMethodType()->getFriendlyType());
        }
    }

    /**
     * @param String $merchantId
     */
    public function setMerchantId($merchantId)
    {
        $this->merchantId = $merchantId;
    }

    /**
     * @param String $projectId
     */
    public function setProjectId($projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @param String $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return String
     */
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return String
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return String
     */
    public function getSecret()
    {
        return $this->secret;
    }
}