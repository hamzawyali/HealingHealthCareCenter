<?php


namespace App\Http\Controllers\Api\Patients\Repository;

use App\Http\Controllers\Api\Patients\Model\Patients;
use App\Http\Controllers\Repository;

class PatientRepository extends Repository
{

    function setModelName()
    {
        return new Patients;
    }

    /**
     * @param array $patient
     * @return integer patient id
     */
    public function checkAndCreate(array $patient)
    {
        $checkPatient = $this->findBy('phone', $patient['phone']);
        if (is_null($checkPatient)) {
            $patientId = $this->create([
                'name' => $patient['name'],
                'email' => $patient['email'],
                'phone' => $patient['phone']
            ])->id;
        } else
            $patientId = $checkPatient->id;

        return $patientId;
    }

    public function getPatientEmail($patient_id)
    {
        return $this->model->select('id', 'email', 'phone')->where('id', $patient_id)->first();
    }
}
