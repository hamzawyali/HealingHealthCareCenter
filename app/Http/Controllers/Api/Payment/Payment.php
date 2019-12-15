<?php


namespace App\Http\Controllers\Api\Payment;


use App\Http\Controllers\Api\Invoices\Repository\InvoicesRepository;
use phpDocumentor\Reflection\Types\Integer;

abstract class Payment
{
    private $invoice;
    protected $patientId;
    private $cardType;
    private $status;
    private $invoiceId;

    public function __construct($data)
    {
        $this->invoice = new InvoicesRepository;
        $this->handleData($data);
        $this->handlePayment();
        $this->getPatientId($this->invoiceId);
    }

    /**
     * @return int
     */
    abstract function setInvoiceId();

    /**
     * @return string
     */
    abstract function setStatus();

    /**
     * @return string
     */
    abstract function setCardType();

    /**
     * handle data received from controller
     * @return void
     */
    abstract function handleData(array $data);


    public function getPatientId(int $invoiceId)
    {
        $getInvoice = $this->invoice->findBy('id', $invoiceId);
        if (is_null($getInvoice))
            return false;
        else
            $this->patientId = $getInvoice->patient_id;
    }


    private function setData()
    {
        $this->invoiceId = $this->setInvoiceId();
        $this->status = $this->setStatus();
        $this->cardType = $this->setCardType();
    }

    public function handlePayment()
    {
        $this->setData();

        if ($this->status == true) {
            $this->invoice->update([
                'status' => 'paid'
            ], $this->invoiceId);
        }
    }
}
