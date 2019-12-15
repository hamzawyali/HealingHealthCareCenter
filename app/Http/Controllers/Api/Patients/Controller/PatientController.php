<?php

namespace App\Http\Controllers\Api\Patients\Controller;

use App\Http\Controllers\Api\Booking\Repository\PatientRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    private $patient;

    /**
     * PatientController constructor.
     */
    public function __construct()
    {
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
            'patient_id' => 'required|string:max:255|unique:medical_services',
        ]);

        if ($check !== true)
            return $check;

        $medicalServicesId = $this->medicalServices->create([
            'name' => $request->name,
            'description' => $request->description
        ])->id;

        return $this->Success201();
    }
}
