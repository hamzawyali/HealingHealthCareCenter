<?php

namespace App\Http\Controllers\Api\MedicalServices\Controller;

use App\Http\Controllers\Api\MedicalServices\Repository\MedicalServicesRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicalServicesController extends Controller
{
    private $medicalServices;

    /**
     * MedicalServicesController constructor.
     */
    public function __construct()
    {
        $this->medicalServices = new MedicalServicesRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $validatedData = $this->patientValidator([
            'id' => 'numeric',
            'name' => 'string',
            'description' => 'string|max:255',
        ]);

        if ($validatedData !== true)
            return $validatedData;


        return $this->Success200(
            $this->medicalServices->getList($request->pagination)
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
            'name' => 'required|string:max:255|unique:medical_services',
            'description' => 'string',
        ]);

        if ($check !== true)
            return $check;

        $medicalServicesId = $this->medicalServices->create([
            'name' => $request->name,
            'description' => $request->description
        ])->id;
//        $this->HandleLog('departments', 'Departments', 'create', $this->user_id, $departmentId);

        return $this->Success201();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $request->request->add([
            'id' => $id
        ]);

        $check = $this->patientValidator([
            'id' => 'required|numeric|exists:medical_services,id',
            'name' => 'required|string:max:255|unique:medical_services,id,' .$id,
            'description' => 'string',
        ]);

        if ($check !== true)
            return $check;

//        $this->HandleLog('tickets', 'Tickets', 'update', $this->user_id, $id);

        $this->medicalServices->update([
            'name' => $request->name,
            'description' => $request->description,
        ], $id);

        return $this->Success202();
    }
}
