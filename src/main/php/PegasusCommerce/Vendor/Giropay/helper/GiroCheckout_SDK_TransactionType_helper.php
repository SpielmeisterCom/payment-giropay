<?php
/**
 * Helper class which manages api call instances
 *
 * @package GiroCheckout
 * @version $Revision: 49 $ / $Date: 2014-07-28 14:28:22 +0200 (Mo, 28 Jul 2014) $
 */
class GiroCheckout_SDK_TransactionType_helper {

    /*
     * returns api call instance
     *
     * @param String api call name
     * @return interfaceAPI
     */
    public static function getTransactionTypeByName($transType) {
        switch($transType) {
            //credit card apis
            case 'creditCardTransaction':           return new GiroCheckout_SDK_CreditCardTransaction();
            case 'creditCardGetPKN':                return new GiroCheckout_SDK_CreditCardGetPKN();
            case 'creditCardRecurringTransaction':  return new GiroCheckout_SDK_CreditCardRecurringTransaction();

            //direct debit apis
            case 'directDebitTransaction':                  return new GiroCheckout_SDK_DirectDebitTransaction();
            case 'directDebitTransactionWithPaymentPage':   return new GiroCheckout_SDK_DirectDebitTransactionWithPaymentPage();

            //giropay apis
            case 'giropayBankstatus':               return new GiroCheckout_SDK_GiropayBankstatus();
            case 'giropayIDCheck':                  return new GiroCheckout_SDK_GiropayIDCheck();
            case 'giropayTransaction':              return new GiroCheckout_SDK_GiropayTransaction();
            case 'giropayTransactionWithGiropayID': return new GiroCheckout_SDK_GiropayTransactionWithGiropayID();

            //iDEAL apis
            case 'idealIssuerList': return new GiroCheckout_SDK_IdealIssuerList();
            case 'idealPayment':    return new GiroCheckout_SDK_IdealPayment();

            //PayPal apis
            case 'paypalTransaction': return new GiroCheckout_SDK_PaypalTransaction();

            //eps apis
            case 'epsBankstatus':               return new GiroCheckout_SDK_EpsBankstatus();
            case 'epsTransaction':              return new GiroCheckout_SDK_EpsTransaction();
            
            //tools apis
            case 'getTransactionTool': return new GiroCheckout_SDK_Tools_GetTransaction();
        }

        return null;
    }
}