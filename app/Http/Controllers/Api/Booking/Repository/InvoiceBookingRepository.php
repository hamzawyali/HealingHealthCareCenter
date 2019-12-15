<?php


namespace App\Http\Controllers\Api\Invoices\Repository;

use App\Http\Controllers\Repository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Api\Invoices\Model\InvoiceBooking;


class InvoiceBookingRepository extends Repository
{
    /**
     * InvoiceBookingRepository constructor.
     */
    function setModelName()
    {
        return new InvoiceBooking;
    }
}
