<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayReasonCodeType {
    private static $TYPES = array();
    /**
     * @var GiropayReasonCodeType
     */
    public static $OK;

    /**
     * @var GiropayReasonCodeType
     */
    public static $AUTHENTICATION_FAILED;

    /**
     * @var GiropayReasonCodeType
     */
    public static $NO_AUTHORIZATION;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_HASH;

    /**
     * @var GiropayReasonCodeType
     */
    public static $MANDATORY_FIELD_NOT_SPECIFIED;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_CALL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MAIL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_LANGUAGE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_COUNTRY;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_BRANCH;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_SHOP_SYSTEM;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_GENDER;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_PRODUCT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_ORGANISATION_TYPE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $MERCHANT_ALREADY_EXIST;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_PSP;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_CREDIT_CARD_TYPE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MERCHANTID;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_PROJECTID;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MERCHANTTXID;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_PURPOSE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_BANKCODE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_BANKACCOUNT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_BIC;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_IBAN;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MOBILE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_PKN;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_AMOUNT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $BANKCODE_OR_BIC_MISSING;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MANDATESEQUENCE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_CURRENCY;

    /**
     * @var GiropayReasonCodeType
     */
    public static $TRANSACTION_DOES_NOT_EXIST;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO1LABEL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO1TEXT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFOLABEL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO2TEXT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO3LABEL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO3TEXT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO4LABEL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO4TEXT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO5LABEL;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_INFO5TEXT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_RECURRING;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MANDATEREFERENCE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MANDATESIGNEDON;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_MANDATERECEIVERNAME;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_ISSUER;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_URLREDIRECT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_URLNOTIFY;

    /**
     * @var GiropayReasonCodeType
     */
    public static $ERROR_FROM_PAYMENT_PROCESSOR;

    /**
     * @var GiropayReasonCodeType
     */
    public static $CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR;

    /**
     * @var GiropayReasonCodeType
     */
    public static $PSEUDO_CARNUMBER_DOES_NOT_EXIST;

    /**
     * @var GiropayReasonCodeType
     */
    public static $NOT_ACCEPTED_TRANSACTION;

    /**
     * @var GiropayReasonCodeType
     */
    public static $GIROPAY_BANK_OFFLINE;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_GIROPAY_BANK_OF_SENDER;

    /**
     * @var GiropayReasonCodeType
     */
    public static $SENDER_BANK_ACCOUNT_BLACKLISTED;

    /**
     * @var GiropayReasonCodeType
     */
    public static $INVALID_SENDER_BANK_ACCOUNT;

    /**
     * @var GiropayReasonCodeType
     */
    public static $BANK_UNKNOWN;

    /**
     * @var GiropayReasonCodeType
     */
    public static $BANK_DOES_NOT_SUPPORT_GIROPAY;

    /**
     * @var GiropayReasonCodeType
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

    public function equals(GiropayReasonCodeType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayReasonCodeType::$OK                                      = new GiropayReasonCodeType(0, "OK");
GiropayReasonCodeType::$AUTHENTICATION_FAILED                   = new GiropayReasonCodeType(5000, "authentication failed");
GiropayReasonCodeType::$NO_AUTHORIZATION                        = new GiropayReasonCodeType(5001, "no authorization");
GiropayReasonCodeType::$INVALID_HASH                            = new GiropayReasonCodeType(5002, "invalid hash");
GiropayReasonCodeType::$MANDATORY_FIELD_NOT_SPECIFIED           = new GiropayReasonCodeType(5003, "mandatory field not specified");
GiropayReasonCodeType::$INVALID_CALL                            = new GiropayReasonCodeType(5004, "invalid call");
GiropayReasonCodeType::$INVALID_MAIL                            = new GiropayReasonCodeType(5009, "invalid mail");
GiropayReasonCodeType::$INVALID_LANGUAGE                        = new GiropayReasonCodeType(5010, "invalid language");
GiropayReasonCodeType::$INVALID_COUNTRY                         = new GiropayReasonCodeType(5011, "invalid country");
GiropayReasonCodeType::$INVALID_BRANCH                          = new GiropayReasonCodeType(5012, "invalid branch");
GiropayReasonCodeType::$INVALID_SHOP_SYSTEM                     = new GiropayReasonCodeType(5013, "invalid shop system");
GiropayReasonCodeType::$INVALID_GENDER                          = new GiropayReasonCodeType(5014, "invalid gender");
GiropayReasonCodeType::$INVALID_PRODUCT                         = new GiropayReasonCodeType(5015, "invalid product");
GiropayReasonCodeType::$INVALID_ORGANISATION_TYPE               = new GiropayReasonCodeType(5016, "invalid organisation type");
GiropayReasonCodeType::$MERCHANT_ALREADY_EXIST                  = new GiropayReasonCodeType(5017, "merchant already exist");
GiropayReasonCodeType::$INVALID_PSP                             = new GiropayReasonCodeType(5018, "invalid PSP");
GiropayReasonCodeType::$INVALID_CREDIT_CARD_TYPE                = new GiropayReasonCodeType(5019, "invalid credit card type");
GiropayReasonCodeType::$INVALID_MERCHANTID                      = new GiropayReasonCodeType(5020, "invalid merchantId");
GiropayReasonCodeType::$INVALID_PROJECTID                       = new GiropayReasonCodeType(5021, "invalid projectId");
GiropayReasonCodeType::$INVALID_MERCHANTTXID                    = new GiropayReasonCodeType(5022, "invalid merchantTxId");
GiropayReasonCodeType::$INVALID_PURPOSE                         = new GiropayReasonCodeType(5023, "invalid purpose");
GiropayReasonCodeType::$INVALID_BANKCODE                        = new GiropayReasonCodeType(5024, "invalid bankcode");
GiropayReasonCodeType::$INVALID_BANKACCOUNT                     = new GiropayReasonCodeType(5025, "invalid bankaccount");
GiropayReasonCodeType::$INVALID_BIC                             = new GiropayReasonCodeType(5026, "invalid bic");
GiropayReasonCodeType::$INVALID_IBAN                            = new GiropayReasonCodeType(5027, "invalid iban");
GiropayReasonCodeType::$INVALID_MOBILE                          = new GiropayReasonCodeType(5028, "invalid mobile");
GiropayReasonCodeType::$INVALID_PKN                             = new GiropayReasonCodeType(5029, "invalid pkn");
GiropayReasonCodeType::$INVALID_AMOUNT                          = new GiropayReasonCodeType(5030, "invalid amount");
GiropayReasonCodeType::$BANKCODE_OR_BIC_MISSING                 = new GiropayReasonCodeType(5031, "bankcode or BIC missing");
GiropayReasonCodeType::$INVALID_MANDATESEQUENCE                 = new GiropayReasonCodeType(5032, "invalid mandateSequence");
GiropayReasonCodeType::$INVALID_CURRENCY                        = new GiropayReasonCodeType(5033, "invalid currency");
GiropayReasonCodeType::$TRANSACTION_DOES_NOT_EXIST              = new GiropayReasonCodeType(5034, "transaction does not exist");
GiropayReasonCodeType::$INVALID_INFO1LABEL                      = new GiropayReasonCodeType(5040, "invalid info1Label");
GiropayReasonCodeType::$INVALID_INFO1TEXT                       = new GiropayReasonCodeType(5041, "invalid info1Text");
GiropayReasonCodeType::$INVALID_INFOLABEL                       = new GiropayReasonCodeType(5042, "invalid info2Label");
GiropayReasonCodeType::$INVALID_INFO2TEXT                       = new GiropayReasonCodeType(5043, "invalid info2Text");
GiropayReasonCodeType::$INVALID_INFO3LABEL                      = new GiropayReasonCodeType(5044, "invalid info3Label");
GiropayReasonCodeType::$INVALID_INFO3TEXT                       = new GiropayReasonCodeType(5045, "invalid info3Text");
GiropayReasonCodeType::$INVALID_INFO4LABEL                      = new GiropayReasonCodeType(5046, "invalid info4Label");
GiropayReasonCodeType::$INVALID_INFO4TEXT                       = new GiropayReasonCodeType(5047, "invalid info4Text");
GiropayReasonCodeType::$INVALID_INFO5LABEL                      = new GiropayReasonCodeType(5048, "invalid info5Label");
GiropayReasonCodeType::$INVALID_INFO5TEXT                       = new GiropayReasonCodeType(5049, "invalid info5Text");
GiropayReasonCodeType::$INVALID_RECURRING                       = new GiropayReasonCodeType(5050, "invalid recurring");
GiropayReasonCodeType::$INVALID_MANDATEREFERENCE                = new GiropayReasonCodeType(5051, "invalid mandateReference");
GiropayReasonCodeType::$INVALID_MANDATESIGNEDON                 = new GiropayReasonCodeType(5052, "invalid mandateSignedOn");
GiropayReasonCodeType::$INVALID_MANDATERECEIVERNAME             = new GiropayReasonCodeType(5053, "invalid mandateReceiverName");
GiropayReasonCodeType::$INVALID_ISSUER                          = new GiropayReasonCodeType(5054, "invalid issuer");
GiropayReasonCodeType::$INVALID_URLREDIRECT                     = new GiropayReasonCodeType(5055, "invalid urlRedirect");
GiropayReasonCodeType::$INVALID_URLNOTIFY                       = new GiropayReasonCodeType(5056, "invalid urlNotify");
GiropayReasonCodeType::$ERROR_FROM_PAYMENT_PROCESSOR            = new GiropayReasonCodeType(5100, "error from payment processor");
GiropayReasonCodeType::$CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR = new GiropayReasonCodeType(5101, "connection problem to payment processor");
GiropayReasonCodeType::$PSEUDO_CARNUMBER_DOES_NOT_EXIST         = new GiropayReasonCodeType(5102, "pseudo-cardnumber does not exist");
GiropayReasonCodeType::$NOT_ACCEPTED_TRANSACTION                = new GiropayReasonCodeType(5200, "not accepted transaction");
GiropayReasonCodeType::$GIROPAY_BANK_OFFLINE                    = new GiropayReasonCodeType(5201, "giropay bank offline");
GiropayReasonCodeType::$INVALID_GIROPAY_BANK_OF_SENDER          = new GiropayReasonCodeType(5202, "invalid giropay bank of sender");
GiropayReasonCodeType::$SENDER_BANK_ACCOUNT_BLACKLISTED         = new GiropayReasonCodeType(5203, "sender bank account blacklisted");
GiropayReasonCodeType::$INVALID_SENDER_BANK_ACCOUNT             = new GiropayReasonCodeType(5204, "invalid sender bank account");
GiropayReasonCodeType::$BANK_UNKNOWN                            = new GiropayReasonCodeType(6001, "bank unknown");
GiropayReasonCodeType::$BANK_DOES_NOT_SUPPORT_GIROPAY           = new GiropayReasonCodeType(6002, "bank does not support giropay");
GiropayReasonCodeType::$INTERNAL_ERROR                          = new GiropayReasonCodeType(9999, "internal error");
