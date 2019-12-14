<?php

namespace App\Http\Controllers\Api\Invoices\Model;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'id', 'agent_id', 'appointment_id', 'status', 'original_amount', 'discount', 'total_amount'
    ];
}
