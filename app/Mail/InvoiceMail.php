<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    private $original_amount;
    private $discount;
    private $total_amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($original_amount, $discount = null, $total_amount)
    {
        $this->original_amount = $original_amount;
        $this->discount = $discount;
        $this->total_amount = $total_amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')->with('original_amount', $this->original_amount)->with('discount', $this->discount)->with('total_amount', $this->total_amount);
    }
}
