<?php

namespace App\Listeners;

use App\Events\UserRegisteredEvent;
use App\Mail\AccountInformation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserRegisteredEmail implements ShouldQueue
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
    public function handle(UserRegisteredEvent $event): void
    {
        $info = array(
            'name' => $event -> user -> name,
            'email' => $event -> user -> email,
        );

        Mail::to($event->user->email)->send(new AccountInformation($info));
    }
}
