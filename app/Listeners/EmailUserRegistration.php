<?php

namespace App\Listeners;

use App\Events\UserWasRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserRegistration implements ShouldQueue
{
    use InteractsWithQueue;
    
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        app('mailer')->raw(print_r($event->user, true), function ($message) {
            $message->to(env('MAIL_FROM_ADDRESS'));
            $message->subject('EmailUserRegistration');
        });
        //throw new \Exception(print_r($event->user, true));
    }
}
