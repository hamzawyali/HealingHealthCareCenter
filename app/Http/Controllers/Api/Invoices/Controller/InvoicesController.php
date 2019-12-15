<?php

namespace App\Http\Controllers\Api\Invoices\Controller;

use App\Http\Controllers\Api\Invoices\Repository\InvoiceBookingRepository;
use App\Http\Controllers\Api\Invoices\Repository\InvoicesRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    private $invoices;
    private $invoiceBooking;

    /**
     * MedicalServicesController constructor.
     */
    public function __construct()
    {
        $this->invoices = new InvoicesRepository;
        $this->invoiceBooking = new InvoiceBookingRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $validatedData = $this->patientValidator([
            'agent_id' => 'required|numeric',
            'appointment_id' => 'required|numeric|exists:appointments,id',
            'status' => 'required|string|in:pending,paid',
            'original_amount' => 'required|numeric',
            'discount' => 'numeric'
        ]);

        if ($validatedData !== true)
            return $validatedData;


        return $this->Success200(
            $this->invoices->getList($request->pagination)
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $check = $this->patientValidator([
            'agent_id' => 'required|numeric', // user_id
            'patient_id' => 'required|numeric|exists:patients,id',
            'booking_ids' => 'required|array',
            'booking_ids.*' => 'required|numeric|max:99999999999|exists:booking,id',
            'original_amount' => 'required|numeric',
            'discount' => 'numeric'
        ]);

        if ($check !== true)
            return $check;

        $this->createInvoiceBooking($request, $this->createInvoice($request));
        return $this->Success201();
    }

    /**
     * @param Request $request
     * @return float|int|mixed
     */
    private function handleDiscount(Request $request)
    {
        if($request->discount != null){
            $total_amount = $request->original_amount - ($request->original_amount * $request->discount / 100);
        }
        else {
            $total_amount = $request->original_amount;
        }

        return $total_amount;
    }

    /**
     * @param Request $request
     * @return integer invoice id
     */
    private function createInvoice(Request $request)
    {
        return $this->invoices->create([
            'agent_id' => $request->agent_id,
            'patient_id' => $request->patient_id,
            'status' => 'pending',
            'original_amount' => $request->original_amount,
            'discount' => $request->discount,
            'total_amount' => $this->handleDiscount($request)
        ])->id;
    }

    private function createInvoiceBooking(Request $request, int $invoice_id)
    {
        foreach ($request->booking_ids as $booking_id){
            $this->invoiceBooking->create([
                'invoice_id' => $invoice_id,
                'booking_id' => $booking_id
            ]);
        }
    }
}
