<?php

namespace App\Listeners;

use App\Events\OrderPlacement;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderPlacement $event): void
    {
        $order = $event->order;
        echo 'sending........................';
    }
}
