<?php

namespace App\Listeners;

use App\Events\MailEvent;
use App\Mail\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class MailListener implements ShouldQueue
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
    public function handle(MailEvent $event): void
    {
        //Sending Mail
        Mail::to($event->data->email)->send(new SendMail($event->data));
    }
}
