<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [   
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
    

        '\B\TMS\E\TaskCreated'=>[
            '\B\TMS\E\L\TaskAdded'

        ],

        '\B\TMS\E\MessagePosted'=>[
            '\B\TMS\E\L\MessageAdded'

        ],



    ];

    protected $subscribe = [
    'B\TMS\E\L\TaskAdded',
];



    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
