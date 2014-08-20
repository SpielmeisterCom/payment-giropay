<?php
/**
 * GiroCheckout SDK.
 *
 * Include just this file. It will load any required files to use the SDK.
 * View examples for API calls.
 *
 * @package GiroCheckout
 * @version $Revision: 49 $ / $Date: 2014-07-28 14:28:22 +0200 (Mo, 28 Jul 2014) $
 */

if(defined('__GIROCHECKOUT_SDK_DEBUG__') && __GIROCHECKOUT_SDK_DEBUG__) {
    require_once 'helper/GiroCheckout_SDK_Debug.php';
    define('__GIROCHECKOUT_SDK_DEBUG_LOG_PATH__', __DIR__.'/log/');
}
else {
	define('__GIROCHECKOUT_SDK_DEBUG__', false);
}

//SDK-files
require_once 'helper/GiroCheckout_SDK_Exception.php';
require_once 'api/GiroCheckout_SDK_InterfaceApi.php';
require_once 'api/GiroCheckout_SDK_AbstractApi.php';
require_once 'helper/GiroCheckout_SDK_TransactionType_helper.php';
require_once 'helper/GiroCheckout_SDK_Hash_helper.php';
require_once 'helper/GiroCheckout_SDK_Curl_helper.php';
require_once 'helper/GiroCheckout_SDK_ResponseCode_helper.php';
require_once 'GiroCheckout_SDK_Request.php';
require_once 'GiroCheckout_SDK_Notify.php';

//payment methods
require_once 'api/giropay/GiroCheckout_SDK_GiropayBankstatus.php';
require_once 'api/giropay/GiroCheckout_SDK_GiropayTransaction.php';
require_once 'api/giropay/GiroCheckout_SDK_GiropayTransactionWithGiropayID.php';
require_once 'api/giropay/GiroCheckout_SDK_GiropayIDCheck.php';

require_once 'api/ideal/GiroCheckout_SDK_IdealIssuerList.php';
require_once 'api/ideal/GiroCheckout_SDK_IdealPayment.php';

require_once 'api/creditcard/GiroCheckout_SDK_CreditCardTransaction.php';
require_once 'api/creditcard/GiroCheckout_SDK_CreditCardRecurringTransaction.php';
require_once 'api/creditcard/GiroCheckout_SDK_CreditCardGetPKN.php';

require_once 'api/directdebit/GiroCheckout_SDK_DirectDebitTransaction.php';
require_once 'api/directdebit/GiroCheckout_SDK_DirectDebitTransactionWithPaymentPage.php';

require_once 'api/paypal/GiroCheckout_SDK_PaypalTransaction.php';

require_once 'api/eps/GiroCheckout_SDK_EpsBankstatus.php';
require_once 'api/eps/GiroCheckout_SDK_EpsTransaction.php';

//tools
require_once 'api/tools/GiroCheckout_SDK_Tools_GetTransaction.php';


