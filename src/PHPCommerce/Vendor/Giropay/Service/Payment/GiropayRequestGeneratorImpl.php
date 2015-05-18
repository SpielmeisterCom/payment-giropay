<?php
namespace PHPCommerce\Vendor\Giropay\Service\Payment;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Message\RequestInterface;
use InvalidArgumentException;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Bankstatus\GiropayBankstatusRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\GiropayRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStartRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Message\Transaction\GiropayTransactionStatusRequest;
use PHPCommerce\Vendor\Giropay\Service\Payment\Type\GiropayMethodType;

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

    protected function getHMACMD5Hash($secret, $data) {
        return hash_hmac('MD5', $data, $secret);
    }

    /**
     * @param ClientInterface $client
     * @param GiropayBankstatusRequest $giropayRequest
     * @return RequestInterface
     */
    protected function buildBankstatusRequest(ClientInterface $client, GiropayBankstatusRequest $giropayRequest) {
        $requestArray = array();
        $requestArray['merchantId']     = $this->getMerchantId();
        $requestArray['projectId']      = $this->getProjectId();

        if($giropayRequest->getBic() == "") {
            throw new InvalidArgumentException("Field bic is required");
        }
        $requestArray['bic']      = $giropayRequest->getBic();

        //this works because the hash list in PHP has a sort order (we get the values out in the order we added them)
        $sortedValuesString             = implode('', array_values($requestArray));

        $requestArray['hash']           = $this->getHMACMD5Hash($this->getSecret(), $sortedValuesString);


        $request = $client->createRequest(
            "POST",
            "https://payment.girosolution.de/girocheckout/api/v2/giropay/bankstatus",
            [
                'body' => $requestArray
            ]
        );

        return $request;
    }

    /**
     * @param ClientInterface $client
     * @param GiropayTransactionStatusRequest $giropayRequest
     * @return RequestInterface
     */
    protected function buildTransactionStatusRequest(ClientInterface $client, GiropayTransactionStatusRequest $giropayRequest)
    {
        $requestArray = array();
        $requestArray['merchantId']     = $this->getMerchantId();
        $requestArray['projectId']      = $this->getProjectId();

        if($giropayRequest->getReference() == "") {
            throw new InvalidArgumentException("Field reference is required");
        }
        $requestArray['reference']      = $giropayRequest->getReference();

        //this works because the hash list in PHP has a sort order (we get the values out in the order we added them)
        $sortedValuesString             = implode('', array_values($requestArray));

        $requestArray['hash']           = $this->getHMACMD5Hash($this->getSecret(), $sortedValuesString);

        $request = $client->createRequest(
            "POST",
            "https://payment.girosolution.de/girocheckout/api/v2/transaction/status",
            [
                'body' => $requestArray
            ]
        );

        return $request;
    }

    /**
     * @param ClientInterface $client
     * @param GiropayTransactionStartRequest $giropayRequest
     * @return RequestInterface
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

        $request = $client->createRequest(
            "POST",
            "https://payment.girosolution.de/girocheckout/api/v2/transaction/start",
            [
                'body' => $requestArray
            ]
        );

        return $request;
    }

    /**
     * @param ClientInterface $client
     * @param GiropayRequest $giropayRequest
     * @return RequestInterface
     */
    public function buildRequest(ClientInterface $client, GiropayRequest $giropayRequest)
    {
        $request = null;

        if(GiropayMethodType::$TRANSACTION_START->equals($giropayRequest->getMethod())) {
            $request = $this->buildTransactionStartRequest($client, $giropayRequest);

        } else if(GiropayMethodType::$TRANSACTION_STATUS->equals($giropayRequest->getMethod())) {
            $request = $this->buildTransactionStatusRequest($client, $giropayRequest);

        } else if(GiropayMethodType::$BANKSTATUS->equals($giropayRequest->getMethod())) {
            $request = $this->buildBankstatusRequest($client, $giropayRequest);

        } else {
            throw new InvalidArgumentException("Method type not supported: " . $giropayRequest->getMethod()->getFriendlyType());
        }

        return $request;
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