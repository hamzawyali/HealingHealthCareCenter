<?php

namespace App\Http\Controllers\Api\Appointments\Model;

use Illuminate\Database\Eloquent\Model;

class Appointments extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'id', 'user_id', 'medical_services_id', 'time'
    ];
}
