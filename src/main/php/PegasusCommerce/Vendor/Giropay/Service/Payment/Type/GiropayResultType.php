<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Type;

class GiropayResultType {
    public static $TYPES = array();

    /**
     * @var GiropayResultType
     */
    public static $OK;

    /**
     * @var GiropayResultType
     */
    public static $AUTHENTICATION_FAILED;

    /**
     * @var GiropayResultType
     */
    public static $NO_AUTHORIZATION;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_HASH;

    /**
     * @var GiropayResultType
     */
    public static $MANDATORY_FIELD_NOT_SPECIFIED;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_CALL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MAIL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_LANGUAGE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_COUNTRY;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_BRANCH;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_SHOP_SYSTEM;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_GENDER;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_PRODUCT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_ORGANISATION_TYPE;

    /**
     * @var GiropayResultType
     */
    public static $MERCHANT_ALREADY_EXIST;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_PSP;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_CREDIT_CARD_TYPE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MERCHANTID;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_PROJECTID;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MERCHANTTXID;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_PURPOSE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_BANKCODE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_BANKACCOUNT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_BIC;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_IBAN;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MOBILE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_PKN;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_AMOUNT;

    /**
     * @var GiropayResultType
     */
    public static $BANKCODE_OR_BIC_MISSING;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MANDATESEQUENCE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_CURRENCY;

    /**
     * @var GiropayResultType
     */
    public static $TRANSACTION_DOES_NOT_EXIST;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO1LABEL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO1TEXT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFOLABEL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO2TEXT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO3LABEL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO3TEXT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO4LABEL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO4TEXT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO5LABEL;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_INFO5TEXT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_RECURRING;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MANDATEREFERENCE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MANDATESIGNEDON;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_MANDATERECEIVERNAME;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_ISSUER;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_URLREDIRECT;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_URLNOTIFY;

    /**
     * @var GiropayResultType
     */
    public static $ERROR_FROM_PAYMENT_PROCESSOR;

    /**
     * @var GiropayResultType
     */
    public static $CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR;

    /**
     * @var GiropayResultType
     */
    public static $PSEUDO_CARNUMBER_DOES_NOT_EXIST;

    /**
     * @var GiropayResultType
     */
    public static $NOT_ACCEPTED_TRANSACTION;

    /**
     * @var GiropayResultType
     */
    public static $GIROPAY_BANK_OFFLINE;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_GIROPAY_BANK_OF_SENDER;

    /**
     * @var GiropayResultType
     */
    public static $SENDER_BANK_ACCOUNT_BLACKLISTED;

    /**
     * @var GiropayResultType
     */
    public static $INVALID_SENDER_BANK_ACCOUNT;

    /**
     * @var GiropayResultType
     */
    public static $BANK_UNKNOWN;

    /**
     * @var GiropayResultType
     */
    public static $BANK_DOES_NOT_SUPPORT_GIROPAY;

    /**
     * @var GiropayResultType
     */
    public static $INTERNAL_ERROR;


    public function __construct($type = null, $friendlyType = null) {
        if ($friendlyType) {
            $this->friendlyType = $friendlyType;
        }

        if ($type != null) {
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

    public function equals(GiropayResultType $obj) {
        return ($this->getType() == $obj->getType());
    }
}

GiropayResultType::$OK                                      = new GiropayResultType("0", "OK");
GiropayResultType::$AUTHENTICATION_FAILED                   = new GiropayResultType("5000", "authentication failed");
GiropayResultType::$NO_AUTHORIZATION                        = new GiropayResultType("5001", "no authorization");
GiropayResultType::$INVALID_HASH                            = new GiropayResultType("5002", "invalid hash");
GiropayResultType::$MANDATORY_FIELD_NOT_SPECIFIED           = new GiropayResultType("5003", "mandatory field not specified");
GiropayResultType::$INVALID_CALL                            = new GiropayResultType("5004", "invalid call");
GiropayResultType::$INVALID_MAIL                            = new GiropayResultType("5009", "invalid mail");
GiropayResultType::$INVALID_LANGUAGE                        = new GiropayResultType("5010", "invalid language");
GiropayResultType::$INVALID_COUNTRY                         = new GiropayResultType("5011", "invalid country");
GiropayResultType::$INVALID_BRANCH                          = new GiropayResultType("5012", "invalid branch");
GiropayResultType::$INVALID_SHOP_SYSTEM                     = new GiropayResultType("5013", "invalid shop system");
GiropayResultType::$INVALID_GENDER                          = new GiropayResultType("5014", "invalid gender");
GiropayResultType::$INVALID_PRODUCT                         = new GiropayResultType("5015", "invalid product");
GiropayResultType::$INVALID_ORGANISATION_TYPE               = new GiropayResultType("5016", "invalid organisation type");
GiropayResultType::$MERCHANT_ALREADY_EXIST                  = new GiropayResultType("5017", "merchant already exist");
GiropayResultType::$INVALID_PSP                             = new GiropayResultType("5018", "invalid PSP");
GiropayResultType::$INVALID_CREDIT_CARD_TYPE                = new GiropayResultType("5019", "invalid credit card type");
GiropayResultType::$INVALID_MERCHANTID                      = new GiropayResultType("5020", "invalid merchantId");
GiropayResultType::$INVALID_PROJECTID                       = new GiropayResultType("5021", "invalid projectId");
GiropayResultType::$INVALID_MERCHANTTXID                    = new GiropayResultType("5022", "invalid merchantTxId");
GiropayResultType::$INVALID_PURPOSE                         = new GiropayResultType("5023", "invalid purpose");
GiropayResultType::$INVALID_BANKCODE                        = new GiropayResultType("5024", "invalid bankcode");
GiropayResultType::$INVALID_BANKACCOUNT                     = new GiropayResultType("5025", "invalid bankaccount");
GiropayResultType::$INVALID_BIC                             = new GiropayResultType("5026", "invalid bic");
GiropayResultType::$INVALID_IBAN                            = new GiropayResultType("5027", "invalid iban");
GiropayResultType::$INVALID_MOBILE                          = new GiropayResultType("5028", "invalid mobile");
GiropayResultType::$INVALID_PKN                             = new GiropayResultType("5029", "invalid pkn");
GiropayResultType::$INVALID_AMOUNT                          = new GiropayResultType("5030", "invalid amount");
GiropayResultType::$BANKCODE_OR_BIC_MISSING                 = new GiropayResultType("5031", "bankcode or BIC missing");
GiropayResultType::$INVALID_MANDATESEQUENCE                 = new GiropayResultType("5032", "invalid mandateSequence");
GiropayResultType::$INVALID_CURRENCY                        = new GiropayResultType("5033", "invalid currency");
GiropayResultType::$TRANSACTION_DOES_NOT_EXIST              = new GiropayResultType("5034", "transaction does not exist");
GiropayResultType::$INVALID_INFO1LABEL                      = new GiropayResultType("5040", "invalid info1Label");
GiropayResultType::$INVALID_INFO1TEXT                       = new GiropayResultType("5041", "invalid info1Text");
GiropayResultType::$INVALID_INFOLABEL                       = new GiropayResultType("5042", "invalid info2Label");
GiropayResultType::$INVALID_INFO2TEXT                       = new GiropayResultType("5043", "invalid info2Text");
GiropayResultType::$INVALID_INFO3LABEL                      = new GiropayResultType("5044", "invalid info3Label");
GiropayResultType::$INVALID_INFO3TEXT                       = new GiropayResultType("5045", "invalid info3Text");
GiropayResultType::$INVALID_INFO4LABEL                      = new GiropayResultType("5046", "invalid info4Label");
GiropayResultType::$INVALID_INFO4TEXT                       = new GiropayResultType("5047", "invalid info4Text");
GiropayResultType::$INVALID_INFO5LABEL                      = new GiropayResultType("5048", "invalid info5Label");
GiropayResultType::$INVALID_INFO5TEXT                       = new GiropayResultType("5049", "invalid info5Text");
GiropayResultType::$INVALID_RECURRING                       = new GiropayResultType("5050", "invalid recurring");
GiropayResultType::$INVALID_MANDATEREFERENCE                = new GiropayResultType("5051", "invalid mandateReference");
GiropayResultType::$INVALID_MANDATESIGNEDON                 = new GiropayResultType("5052", "invalid mandateSignedOn");
GiropayResultType::$INVALID_MANDATERECEIVERNAME             = new GiropayResultType("5053", "invalid mandateReceiverName");
GiropayResultType::$INVALID_ISSUER                          = new GiropayResultType("5054", "invalid issuer");
GiropayResultType::$INVALID_URLREDIRECT                     = new GiropayResultType("5055", "invalid urlRedirect");
GiropayResultType::$INVALID_URLNOTIFY                       = new GiropayResultType("5056", "invalid urlNotify");
GiropayResultType::$ERROR_FROM_PAYMENT_PROCESSOR            = new GiropayResultType("5100", "error from payment processor");
GiropayResultType::$CONNECTION_PROBLEM_TO_PAYMENT_PROCESSOR = new GiropayResultType("5101", "connection problem to payment processor");
GiropayResultType::$PSEUDO_CARNUMBER_DOES_NOT_EXIST         = new GiropayResultType("5102", "pseudo-cardnumber does not exist");
GiropayResultType::$NOT_ACCEPTED_TRANSACTION                = new GiropayResultType("5200", "not accepted transaction");
GiropayResultType::$GIROPAY_BANK_OFFLINE                    = new GiropayResultType("5201", "giropay bank offline");
GiropayResultType::$INVALID_GIROPAY_BANK_OF_SENDER          = new GiropayResultType("5202", "invalid giropay bank of sender");
GiropayResultType::$SENDER_BANK_ACCOUNT_BLACKLISTED         = new GiropayResultType("5203", "sender bank account blacklisted");
GiropayResultType::$INVALID_SENDER_BANK_ACCOUNT             = new GiropayResultType("5204", "invalid sender bank account");
GiropayResultType::$BANK_UNKNOWN                            = new GiropayResultType("6001", "bank unknown");
GiropayResultType::$BANK_DOES_NOT_SUPPORT_GIROPAY           = new GiropayResultType("6002", "bank does not support giropay");
GiropayResultType::$INTERNAL_ERROR                          = new GiropayResultType("9999", "internal error");
