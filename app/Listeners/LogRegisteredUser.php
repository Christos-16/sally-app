<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Models\UserLog;

class LogRegisteredUser
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        // Initialization code can go here
    }

    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Registered  $event
     * @return void
     */
    public function handle(Registered $event): void
    {
        $event->user->logAction('registered');
    }
}
