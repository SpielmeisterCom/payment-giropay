<?php

class GiroCheckout_SDK_Exception extends Exception {
	
	public function __construct($message = null, $code = 0) {
	
		if(__GIROCHECKOUT_SDK_DEBUG__) GiroCheckout_SDK_Debug::getInstance()->LogException($message);
		
		echo $message;
		
		parent::__construct($message, $code);
	
	}
}