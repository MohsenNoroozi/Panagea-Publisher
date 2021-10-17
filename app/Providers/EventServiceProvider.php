<?php

namespace App\Providers;

use App\Events\MessagePublishedToTopic;
use App\Listeners\SendRequestToSubscribers;
//use function Illuminate\Events\queueable;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        MessagePublishedToTopic::class => [
            SendRequestToSubscribers::class,
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
