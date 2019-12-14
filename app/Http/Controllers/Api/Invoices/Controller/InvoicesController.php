<?php

namespace App\Http\Controllers\Api\Invoices\Controller;

use App\Http\Controllers\Api\Invoices\Repository\InvoicesRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvoicesController extends Controller
{
    private $invoices;

    /**
     * MedicalServicesController constructor.
     */
    public function __construct()
    {
        $this->invoices = new InvoicesRepository;
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
            'agent_id' => 'required|numeric',
            'appointment_id' => 'required|numeric|exists:appointments,id',
            'status' => 'required|string|in:pending,paid',
            'original_amount' => 'required|numeric',
            'discount' => 'numeric'
        ]);

        if($request->discount != null){
            $total_amount = $request->original_amount - ($request->original_amount * $request->discount / 100);
            $request->request->add([
                'total_amount' => $total_amount
            ]);
        }
        else {
            $total_amount = $request->original_amount;
            $request->request->add([
                'total_amount' => $request->original_amount
            ]);
        }

        if ($check !== true)
            return $check;

        $invoicesId = $this->invoices->create([
            'agent_id' => $request->agent_id,
            'appointment_id' => $request->appointment_id,
            'status' => $request->status,
            'original_amount' => $request->original_amount,
            'discount' => $request->discount,
            'total_amount' => $total_amount
        ])->id;
//        $this->HandleLog('departments', 'Departments', 'create', $this->user_id, $departmentId);

        return $this->Success201();
    }
}
