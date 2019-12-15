<?php

namespace App\Http\Controllers\Api\Booking\Model;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';

    protected $fillable = [
        'id', 'patient_id', 'medical_services_id', 'notes', 'date_time'
    ];

    public function Patient()
    {
        return $this->belongsTo('App\Http\Controllers\Api\Patients\Model\Patients', 'patient_id');
    }

    public function MedicalServices()
    {
        return $this->belongsTo('App\Http\Controllers\Api\MedicalServices\Model\MedicalServices', 'medical_services_id');
    }


}
