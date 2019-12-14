<?php

namespace App\Http\Controllers\Api\Appointments\Controller;

use App\Http\Controllers\Api\Appointments\Repository\AppointmentsRepository;
use App\Http\Controllers\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentsController extends Controller
{
    private $appointments;

    /**
     * AppointmentsController constructor.
     */
    public function __construct()
    {
        $this->appointments = new AppointmentsRepository;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function list(Request $request)
    {
        $validatedData = $this->patientValidator([
            'id' => 'numeric',
            'user_id' => 'numeric',
            'medical_services_id' => 'numeric',
            'time' => 'date_format:"Y-m-d H:i:s',
        ]);

        if ($validatedData !== true)
            return $validatedData;


        return $this->Success200(
            $this->appointments->getList($request->pagination)
        );
    }
}
