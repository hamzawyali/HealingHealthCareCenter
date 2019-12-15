<?php

namespace App\Http\Controllers\Api\Invoices\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceBooking extends Model
{
    protected $table = 'invoice_booking';

    protected $fillable = [
        'id', 'invoice_id', 'booking_id'
    ];
}
