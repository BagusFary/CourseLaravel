<?php

namespace App\Jobs;

use App\Notifications\InvoiceNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class OrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $users,
              $invoiceData;


    /**
     * Create a new job instance.
     */
    public function __construct($users, $invoiceData)
    {
        $this->users = $users;
        $this->invoiceData = $invoiceData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->users->notify(new InvoiceNotification($this->invoiceData));
    }
}
