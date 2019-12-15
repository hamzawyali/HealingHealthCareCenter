<?php

namespace App\Http\Controllers\Api\Patients\Model;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'id', 'name', 'email', 'phone'
    ];
}
