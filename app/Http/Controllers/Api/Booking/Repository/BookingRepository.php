<?php


namespace App\Http\Controllers\Api\Booking\Repository;


use App\Http\Controllers\Api\Booking\Model\Agents;
use App\Http\Controllers\Repository;

class BookingRepository extends Repository
{

    function setModelName()
    {
        return new Agents;
    }

    public function getList($phone)
    {

        $data = $this->model->select('id', 'patient_id', 'medical_services_id', 'date_time', 'notes')
            ->with([
                'Patient' => function ($patient){
                    $patient->select('id', 'name', 'phone', 'email');
                },
                'MedicalServices' => function ($medicalServices){
                    $medicalServices->select('id', 'name', 'description');
                }
            ])
            ->whereHas('Patient', function($patient) use ($phone){
                $patient->where('phone', $phone);
            })
            ->orderBy('id', 'ASC');


        return $data->get();
    }
}
