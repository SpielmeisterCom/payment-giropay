<?php
/**
 * Request class which manages API calls to GiroCheckout
 *
 * how to use (see example section):
 * 1. Instantiate a new Request class and pass an api method to the constructor.
 * 2. Pass the submit params (see api documentation) and call submit().
 * 3. Use the getResponseParam to retrieve the result.
 *
 * @package GiroCheckout
 * @version $Revision: 47 $ / $Date: 2014-07-11 10:04:41 +0200 (Fr, 11 Jul 2014) $
 */

class GiroCheckout_SDK_Request {

    /*
     * stores any committed request parameter which should be sent to GiroConnect
     */
    private $params = Array();

    /*
     * stores any response parameter from GiroConnect answer
     */
    private $response = Array();

    /*
     * stores given secret
     */
    private $secret = '';

    /*
     * stores the api call request method object
     */
    private $requestMethod;


    /**
     * instantiates request
     *
     * a request method instance has to be passed (see examples section)
     *
     * @param InterfaceApi/String $apiCallMethod
     */
    function __construct($apiCallMethod) {

        if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->init('request');

        if(is_object($apiCallMethod)) {
          $this->requestMethod = $apiCallMethod;

          if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->logTransaction(get_class($apiCallMethod));
        }
        elseif (is_string($apiCallMethod)) {
          $this->requestMethod = GiroCheckout_SDK_TransactionType_helper::getTransactionTypeByName($apiCallMethod);

          if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->logTransaction($apiCallMethod);

          if(is_null($this->requestMethod))
              throw new GiroCheckout_SDK_Exception('Failure: API call method unknown');
        }
    }

    /*
     * Adds a key value pair to the params variable. Used to fill the request with data.
     *
     * @param String $param key
     * @param String $value value
     * @return Request $this own instance
     */
    public function addParam($param, $value){

        if(!$this->requestMethod->hasParam($param)) {
            throw new GiroCheckout_SDK_Exception('Failure: param "'.$param.'" not valid or misspelled. Please check API Params List.');
        }
        $this->params[$param] = $value;
        return $this;
    }

    /*
     * Removes a key value pair from the params variable.
     *
     * @param String $param key
     * @return Request $this own instance
     */
    public function unsetParam($param) {
        unset($this->params[$param]);
        return $this;
    }

    /*
     * Returns the value from the params variable by the given key.
     *
     * @param String $param key
     * @return String $value value assigned to the given key
     */
    public function getParam($param){
        if(isset($this->param[$param])) {
            return $this->param[$param];
        }
        return null;
    }

    /*
     * Returns the value from the response of the request.
     *
     * @param String $param key
     * @return null/String $value value assigned to the given key
     */
    public function getResponseParam($param){
        if(isset($this->response[$param])) {
            return $this->response[$param];
        }
        return null;
    }

    /**
     * Returns an array of all values from the response of the request.
     *
     * @return array Response values
     */
    public function getResponseParams() {
      return $this->response;
    }

    /**
     * Sets the secret which is used for hash generation or hash comparison.
     *
     * @param String $secret
     * @return String $this own instance
     */
    public function setSecret($secret){
        $this->secret = $secret;
        return $this;
    }

    /**
     * Submits the request to the GiroCheckout API by using the given request method. Uses all given and needed
     * params in the correct order.
     *
     * @return boolean
     */
    public function submit() {
        $header = array();
        $body = '';

        if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->logParamsSet($this->params);

        try {
            $submitParams = $this->requestMethod->getSubmitParams($this->params);

            if($this->requestMethod->needsHash()) {
                $submitParams['hash'] = GiroCheckout_SDK_hash_helper::getHMACMD5Hash($this->secret,$this->params);
            }

            list($header,$body) = GiroCheckout_SDK_curl_helper::submit($this->requestMethod->getRequestURL(), $submitParams);
            $response = GiroCheckout_SDK_curl_helper::getJSONResponseToArray($body);

            if($response['rc'] == 5000 || $response['rc'] == 5001) {
                throw new GiroCheckout_SDK_Exception('authentication failure');
            }
            elseif (!isset($header['hash'])) {
                throw new GiroCheckout_SDK_Exception('hash in response is missing');
            }
            elseif (isset($header['hash']) && $header['hash'] !== GiroCheckout_SDK_hash_helper::getHMACMD5HashString($this->secret,$body)) {
                throw new GiroCheckout_SDK_Exception('hash mismatch in response');
            }
            else {
                $this->response = $this->requestMethod->checkResponse($response);
                if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->logReplyParams($this->response);
            }
        }
        catch (Exception $e) {
            throw new GiroCheckout_SDK_Exception('Failure: '.  $e->getMessage()."\n".implode("\r\n",$header).$body);
        }

        return TRUE;
    }

    /**
     * Returns true if the request has succeeded and the response had no ErrorCode. It doesn't check if the transaction
     * or payment has succeeded.
     *
     * @return bool
     */
    public function requestHasSucceeded() {
        if(isset($this->response['rc'])
            && $this->response['rc'] == 0) return TRUE;

        return FALSE;
    }

    /**
     * modifies header to sent redirect location by GiroConnect
     */
    public function redirectCustomerToPaymentProvider() {
        if(isset($this->response['redirect'])) {
            header('location:'.$this->response['redirect']);
        }
    }

    /*
     * Gives response message to given code number in the given language.
     *
     * @param integer code
     * @param String language
     * @return String thee codes description in given language
     */
    public function getResponseMessage($responseCode,$lang = 'DE') {
        return GiroCheckout_SDK_ResponseCode_helper::getMessage($responseCode,$lang);
    }

    /*
     * sets a certificate file which is used for authorising ssl connection 
     *
     * @param String filename including path
     * @return $this own instance
     */
    public function setSslCertFile($certFile) {
    	define('__GIROSOLUTION_SDK_CERT__', $certFile);
    	return $this;
    }
    
    /*
     * disables a certificate verifycation for ssl connections
     *
     * @return $this own instance
     */
    public function setSslVerifyDisabled() {
    	define('__GIROSOLUTION_SDK_SSL_VERIFY_OFF__', true);
    	return $this;
    }
    
    /*
     * returns true if the payment transaction was successful
     *
     * @return boolean result of payment
     */
    public function paymentSuccessful() {
        if ($this->requestHasSucceeded()
        	&& $this->requestMethod->getTransactionSuccessfulCode() != null
            && !$this->requestMethod->hasNotifyURL()) {
            return $this->requestMethod->getTransactionSuccessfulCode() == $this->response['resultPayment'];
        }

        return false;
    }
}