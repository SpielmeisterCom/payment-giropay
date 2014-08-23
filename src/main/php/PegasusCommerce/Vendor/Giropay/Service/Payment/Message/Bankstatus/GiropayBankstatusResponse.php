<?php
namespace PegasusCommerce\Vendor\Giropay\Service\Payment\Message\Bankstatus;


use PegasusCommerce\Vendor\Giropay\Service\Payment\Message\GiropayResponse;

class GiropayBankstatusResponse extends GiropayResponse {
    /**
     * Error-number
     * @var int
     */
    protected $rc;

    /**
     * Contains additional information if an error occured
     * @var string
     */
    protected $msg;

    /**
     * Optional
     * Bank code of the bank
     * @var int
     */
    protected $bankcode;

    /**
     * Optional
     * Bic of the bank
     * @var string
     */
    protected $bic;

    /**
     * Optional
     * Name of the bank
     * @var string
     */
    protected $bankname;

    /**
     * Optional
     * 0 = giropay payment is not supported
     * 1 = giropay payment is supported
     */
    protected $giropay;


    /**
     * Optional
     * 0=giropay-ID and giropay-ID + giropay are not supported
     * 1=giropay-ID und giropay-ID + giropay are supported
     * @var int
     */
    protected $giropayid;

    /**
     * @return int
     */
    public function getBankcode()
    {
        return $this->bankcode;
    }

    /**
     * @param int $bankcode
     */
    public function setBankcode($bankcode)
    {
        $this->bankcode = $bankcode;
    }

    /**
     * @return string
     */
    public function getBankname()
    {
        return $this->bankname;
    }

    /**
     * @param string $bankname
     */
    public function setBankname($bankname)
    {
        $this->bankname = $bankname;
    }

    /**
     * @return string
     */
    public function getBic()
    {
        return $this->bic;
    }

    /**
     * @param string $bic
     */
    public function setBic($bic)
    {
        $this->bic = $bic;
    }

    /**
     * @return mixed
     */
    public function getGiropay()
    {
        return $this->giropay;
    }

    /**
     * @param mixed $giropay
     */
    public function setGiropay($giropay)
    {
        $this->giropay = $giropay;
    }

    /**
     * @return int
     */
    public function getGiropayid()
    {
        return $this->giropayid;
    }

    /**
     * @param int $giropayid
     */
    public function setGiropayid($giropayid)
    {
        $this->giropayid = $giropayid;
    }

    /**
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param string $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return int
     */
    public function getRc()
    {
        return $this->rc;
    }

    /**
     * @param int $rc
     */
    public function setRc($rc)
    {
        $this->rc = $rc;
    }



}