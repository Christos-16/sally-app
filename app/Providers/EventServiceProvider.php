<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\LogRegisteredUser;
use App\Listeners\LogLoggedInUser;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            LogRegisteredUser::class,
        ],
        Login::class => [
            LogLoggedInUser::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
        // Other event listeners...
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
