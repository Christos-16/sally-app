<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use App\Models\UserLog;

class LogLoggedInUser
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
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event): void
    {
        $event->user->logAction('logged in');
    }
}
