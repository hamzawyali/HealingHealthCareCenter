<?php


namespace App\Http\Controllers\Api\Payment;


class PaymentY extends Payment
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
    function setInvoiceId(): integer
    {
        return $this->invoiceId;
    }

    /**
     * @inheritDoc
     */
    function setStatus(): string
    {
        return $this->status;
    }

    /**
     * @inheritDoc
     */
    function setCardType(): string
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
