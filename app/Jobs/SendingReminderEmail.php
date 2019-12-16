<?php

namespace App\Jobs;

use App\Http\Controllers\Api\Invoices\Repository\InvoicesRepository;
use App\Mail\InvoiceMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendingReminderEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $original_amount;
    private $discount;
    private $total_amount;
    /**
     * @var InvoicesRepository
     */
    private $invoice;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->invoice = new InvoicesRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // check invoice time valid
        $data = $this->invoice->check48Hours();
        // send notification to user
        foreach ($data as $row) {
            Mail::to($row['patient']['email'])->send(new InvoiceMail($row['original_amount'], $row['discount'], $row['total_amount']));
            $this->invoice->update(['is_notification' => 1], $row['id']);
        }
    }
}
