<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayResultCodeType {
    private static $TYPES = array();
    /**
     * @var GiropayResultCodeType
     */
    public static $OK;

    /**
     * @var GiropayResultCodeType
     */
    public static $AUTHENTICATION_FAILED;

    /**
     * @var GiropayResultCodeType
     */
    public static $NO_AUTHORIZATION;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_HASH;

    /**
     * @var GiropayResultCodeType
     */
    public static $MANDATORY_FIELD_NOT_SPECIFIED;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_CALL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MAIL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_LANGUAGE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_COUNTRY;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_BRANCH;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_SHOP_SYSTEM;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_GENDER;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_PRODUCT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_ORGANISATION_TYPE;

    /**
     * @var GiropayResultCodeType
     */
    public static $MERCHANT_ALREADY_EXIST;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_PSP;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_CREDIT_CARD_TYPE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MERCHANTID;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_PROJECTID;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MERCHANTTXID;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_PURPOSE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_BANKCODE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_BANKACCOUNT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_BIC;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_IBAN;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MOBILE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_PKN;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_AMOUNT;

    /**
     * @var GiropayResultCodeType
     */
    public static $BANKCODE_OR_BIC_MISSING;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MANDATESEQUENCE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_CURRENCY;

    /**
     * @var GiropayResultCodeType
     */
    public static $TRANSACTION_DOES_NOT_EXIST;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO1LABEL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO1TEXT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFOLABEL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO2TEXT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO3LABEL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO3TEXT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO4LABEL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO4TEXT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO5LABEL;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_INFO5TEXT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_RECURRING;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MANDATEREFERENCE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MANDATESIGNEDON;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_MANDATERECEIVERNAME;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_ISSUER;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_URLREDIRECT;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_URLNOTIFY;

    /**
     * @var GiropayResultCodeType
     */
    public static $ERROR_FROM_PAYMENT_PROCESSOR;

    /**
     * @var GiropayResultCodeType
     */
    public static $CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR;

    /**
     * @var GiropayResultCodeType
     */
    public static $PSEUDO_CARNUMBER_DOES_NOT_EXIST;

    /**
     * @var GiropayResultCodeType
     */
    public static $NOT_ACCEPTED_TRANSACTION;

    /**
     * @var GiropayResultCodeType
     */
    public static $GIROPAY_BANK_OFFLINE;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_GIROPAY_BANK_OF_SENDER;

    /**
     * @var GiropayResultCodeType
     */
    public static $SENDER_BANK_ACCOUNT_BLACKLISTED;

    /**
     * @var GiropayResultCodeType
     */
    public static $INVALID_SENDER_BANK_ACCOUNT;

    /**
     * @var GiropayResultCodeType
     */
    public static $BANK_UNKNOWN;

    /**
     * @var GiropayResultCodeType
     */
    public static $BANK_DOES_NOT_SUPPORT_GIROPAY;

    /**
     * @var GiropayResultCodeType
     */
    public static $INTERNAL_ERROR;


    public function __construct($type = null, $friendlyType = null) {
        if ($friendlyType) {
            $this->friendlyType = $friendlyType;
        }

        if ($type) {
            $this->setType($type);
        }
    }

    public function getType() {
        return $this->type;
    }

    public function getFriendlyType() {
        return $this->friendlyType;
    }

    private function setType($type) {
        $this->type = $type;

        if (!array_key_exists($type, self::$TYPES)) {
            self::$TYPES[$type] = $this;
        }
    }

    public function equals(GiropayResultCodeType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayResultCodeType::$OK                                      = new GiropayResultCodeType(0, "OK");
GiropayResultCodeType::$AUTHENTICATION_FAILED                   = new GiropayResultCodeType(5000, "authentication failed");
GiropayResultCodeType::$NO_AUTHORIZATION                        = new GiropayResultCodeType(5001, "no authorization");
GiropayResultCodeType::$INVALID_HASH                            = new GiropayResultCodeType(5002, "invalid hash");
GiropayResultCodeType::$MANDATORY_FIELD_NOT_SPECIFIED           = new GiropayResultCodeType(5003, "mandatory field not specified");
GiropayResultCodeType::$INVALID_CALL                            = new GiropayResultCodeType(5004, "invalid call");
GiropayResultCodeType::$INVALID_MAIL                            = new GiropayResultCodeType(5009, "invalid mail");
GiropayResultCodeType::$INVALID_LANGUAGE                        = new GiropayResultCodeType(5010, "invalid language");
GiropayResultCodeType::$INVALID_COUNTRY                         = new GiropayResultCodeType(5011, "invalid country");
GiropayResultCodeType::$INVALID_BRANCH                          = new GiropayResultCodeType(5012, "invalid branch");
GiropayResultCodeType::$INVALID_SHOP_SYSTEM                     = new GiropayResultCodeType(5013, "invalid shop system");
GiropayResultCodeType::$INVALID_GENDER                          = new GiropayResultCodeType(5014, "invalid gender");
GiropayResultCodeType::$INVALID_PRODUCT                         = new GiropayResultCodeType(5015, "invalid product");
GiropayResultCodeType::$INVALID_ORGANISATION_TYPE               = new GiropayResultCodeType(5016, "invalid organisation type");
GiropayResultCodeType::$MERCHANT_ALREADY_EXIST                  = new GiropayResultCodeType(5017, "merchant already exist");
GiropayResultCodeType::$INVALID_PSP                             = new GiropayResultCodeType(5018, "invalid PSP");
GiropayResultCodeType::$INVALID_CREDIT_CARD_TYPE                = new GiropayResultCodeType(5019, "invalid credit card type");
GiropayResultCodeType::$INVALID_MERCHANTID                      = new GiropayResultCodeType(5020, "invalid merchantId");
GiropayResultCodeType::$INVALID_PROJECTID                       = new GiropayResultCodeType(5021, "invalid projectId");
GiropayResultCodeType::$INVALID_MERCHANTTXID                    = new GiropayResultCodeType(5022, "invalid merchantTxId");
GiropayResultCodeType::$INVALID_PURPOSE                         = new GiropayResultCodeType(5023, "invalid purpose");
GiropayResultCodeType::$INVALID_BANKCODE                        = new GiropayResultCodeType(5024, "invalid bankcode");
GiropayResultCodeType::$INVALID_BANKACCOUNT                     = new GiropayResultCodeType(5025, "invalid bankaccount");
GiropayResultCodeType::$INVALID_BIC                             = new GiropayResultCodeType(5026, "invalid bic");
GiropayResultCodeType::$INVALID_IBAN                            = new GiropayResultCodeType(5027, "invalid iban");
GiropayResultCodeType::$INVALID_MOBILE                          = new GiropayResultCodeType(5028, "invalid mobile");
GiropayResultCodeType::$INVALID_PKN                             = new GiropayResultCodeType(5029, "invalid pkn");
GiropayResultCodeType::$INVALID_AMOUNT                          = new GiropayResultCodeType(5030, "invalid amount");
GiropayResultCodeType::$BANKCODE_OR_BIC_MISSING                 = new GiropayResultCodeType(5031, "bankcode or BIC missing");
GiropayResultCodeType::$INVALID_MANDATESEQUENCE                 = new GiropayResultCodeType(5032, "invalid mandateSequence");
GiropayResultCodeType::$INVALID_CURRENCY                        = new GiropayResultCodeType(5033, "invalid currency");
GiropayResultCodeType::$TRANSACTION_DOES_NOT_EXIST              = new GiropayResultCodeType(5034, "transaction does not exist");
GiropayResultCodeType::$INVALID_INFO1LABEL                      = new GiropayResultCodeType(5040, "invalid info1Label");
GiropayResultCodeType::$INVALID_INFO1TEXT                       = new GiropayResultCodeType(5041, "invalid info1Text");
GiropayResultCodeType::$INVALID_INFOLABEL                       = new GiropayResultCodeType(5042, "invalid info2Label");
GiropayResultCodeType::$INVALID_INFO2TEXT                       = new GiropayResultCodeType(5043, "invalid info2Text");
GiropayResultCodeType::$INVALID_INFO3LABEL                      = new GiropayResultCodeType(5044, "invalid info3Label");
GiropayResultCodeType::$INVALID_INFO3TEXT                       = new GiropayResultCodeType(5045, "invalid info3Text");
GiropayResultCodeType::$INVALID_INFO4LABEL                      = new GiropayResultCodeType(5046, "invalid info4Label");
GiropayResultCodeType::$INVALID_INFO4TEXT                       = new GiropayResultCodeType(5047, "invalid info4Text");
GiropayResultCodeType::$INVALID_INFO5LABEL                      = new GiropayResultCodeType(5048, "invalid info5Label");
GiropayResultCodeType::$INVALID_INFO5TEXT                       = new GiropayResultCodeType(5049, "invalid info5Text");
GiropayResultCodeType::$INVALID_RECURRING                       = new GiropayResultCodeType(5050, "invalid recurring");
GiropayResultCodeType::$INVALID_MANDATEREFERENCE                = new GiropayResultCodeType(5051, "invalid mandateReference");
GiropayResultCodeType::$INVALID_MANDATESIGNEDON                 = new GiropayResultCodeType(5052, "invalid mandateSignedOn");
GiropayResultCodeType::$INVALID_MANDATERECEIVERNAME             = new GiropayResultCodeType(5053, "invalid mandateReceiverName");
GiropayResultCodeType::$INVALID_ISSUER                          = new GiropayResultCodeType(5054, "invalid issuer");
GiropayResultCodeType::$INVALID_URLREDIRECT                     = new GiropayResultCodeType(5055, "invalid urlRedirect");
GiropayResultCodeType::$INVALID_URLNOTIFY                       = new GiropayResultCodeType(5056, "invalid urlNotify");
GiropayResultCodeType::$ERROR_FROM_PAYMENT_PROCESSOR            = new GiropayResultCodeType(5100, "error from payment processor");
GiropayResultCodeType::$CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR = new GiropayResultCodeType(5101, "connection problem to payment processor");
GiropayResultCodeType::$PSEUDO_CARNUMBER_DOES_NOT_EXIST         = new GiropayResultCodeType(5102, "pseudo-cardnumber does not exist");
GiropayResultCodeType::$NOT_ACCEPTED_TRANSACTION                = new GiropayResultCodeType(5200, "not accepted transaction");
GiropayResultCodeType::$GIROPAY_BANK_OFFLINE                    = new GiropayResultCodeType(5201, "giropay bank offline");
GiropayResultCodeType::$INVALID_GIROPAY_BANK_OF_SENDER          = new GiropayResultCodeType(5202, "invalid giropay bank of sender");
GiropayResultCodeType::$SENDER_BANK_ACCOUNT_BLACKLISTED         = new GiropayResultCodeType(5203, "sender bank account blacklisted");
GiropayResultCodeType::$INVALID_SENDER_BANK_ACCOUNT             = new GiropayResultCodeType(5204, "invalid sender bank account");
GiropayResultCodeType::$BANK_UNKNOWN                            = new GiropayResultCodeType(6001, "bank unknown");
GiropayResultCodeType::$BANK_DOES_NOT_SUPPORT_GIROPAY           = new GiropayResultCodeType(6002, "bank does not support giropay");
GiropayResultCodeType::$INTERNAL_ERROR                          = new GiropayResultCodeType(9999, "internal error");
