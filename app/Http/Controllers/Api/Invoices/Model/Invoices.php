<?php

namespace App\Http\Controllers\Api\Invoices\Model;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'id', 'agent_id', 'patient_id', 'status', 'original_amount', 'discount', 'total_amount', 'is_notification'
    ];

    public function InvoiceBooking()
    {
        return $this->hasMany('App\Http\Controllers\Api\Invoices\Model\InvoiceBooking', 'invoice_id');
    }

    public function Patient()
    {
        return $this->belongsTo('App\Http\Controllers\Api\Patients\Model\Patients', 'patient_id');
    }
}
