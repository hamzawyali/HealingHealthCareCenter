<?php


namespace App\Http\Controllers\Api\Payment;

use Illuminate\Http\Request;

class PaymentX extends Payment
{
    private $cardType;
    private $invoiceId;
    private $status;

    public function __construct($data)
    {
        Parent::__construct($data);
    }

    /**
     * @inheritDoc
     */
    function setInvoiceId()
    {
        return intval($this->invoiceId);
    }

    /**
     * @inheritDoc
     */
    function setStatus()
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    function setCardType()
    {
        return $this->cardType;
    }

    /**
     * @inheritDoc
     */
    function handleData(array $data)
    {
        $this->cardType = $data['cardType'];
        $this->invoiceId = $data['invoiceId'];;
        $this->status = $data['status'];;
    }
}
