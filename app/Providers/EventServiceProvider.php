<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // SocialiteProviders packages register their driver by listening for this event;
        // without the mapping Socialite has no "openidconnect" driver and every SSO
        // request fails with "Driver [openidconnect] not supported", however complete the
        // configuration is. Installing the package alone is not enough.
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\OpenIDConnect\OpenIDConnectExtendSocialite::class.'@handle',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
