<?php

namespace App\Http\Controllers\Api\Booking\Controller;

use App\Http\Controllers\Api\Booking\Repository\BookingRepository;
use App\Http\Controllers\Api\Patients\Repository\PatientRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller implements BookingInterFace
{
    /**
     * @var BookingRepository
     */
    private $booking;
    /**
     * @var PatientRepository
     */
    private $patient;

    /**
     * PatientController constructor.
     */
    public function __construct()
    {
        $this->booking = new BookingRepository;
        $this->patient = new PatientRepository;
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
            'medical_services_id' => 'required|numeric|max:99999999999|exists:medical_services,id',
            'notes' => 'string|max:500',
            'date_time' => 'date_format:"Y-m-d H:i:s',
            'patient' => 'required|array',
            'patient.name' => 'required|string:max:255',
            'patient.email' => 'required|email|unique:patients,email',
            'patient.phone' => 'required|string:max:15|unique:patients,phone',
        ]);

        if ($check !== true)
            return $check;

        $patientId = $this->patient->checkAndCreate($request->patient);

        $this->booking->create([
            'medical_services_id' => $request->medical_services_id,
            'notes' => $request->notes,
            'date_time' => $request->date_time,
            'patient_id' => $patientId,
        ])->id;

        return $this->Success201();
    }


    public function list($phone)
    {
        $validatedData = $this->patientValidator([
            'phone' => 'numeric|exists:patients,phone',
        ], ['phone' => $phone]);

        if ($validatedData !== true)
            return $validatedData;


        return $this->Success200(
            $this->booking->getList($phone)
        );
    }
}
