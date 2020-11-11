<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DonatedItemNotification;

class SendDonatedItemNotiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admins;
    public $notiData;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admins, $notiData)
    {
        $this->admins = $admins;
        $this->notiData = $notiData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Notification::send($this->admins, new DonatedItemNotification($this->notiData));
    }
}
