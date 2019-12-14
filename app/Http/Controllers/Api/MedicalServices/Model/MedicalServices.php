<?php

namespace App\Http\Controllers\Api\MedicalServices\Model;

use Illuminate\Database\Eloquent\Model;

class MedicalServices extends Model
{
    protected $table = 'medical_services';

    protected $fillable = [
        'id', 'name', 'description'
    ];
}
