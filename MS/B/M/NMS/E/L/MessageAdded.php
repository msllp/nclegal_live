<?php

namespace B\TMS\E\L;

use B\TMS\E\TaskCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessagedAdded
{
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
     * @param  TaskCreated  $event
     * @return void
     */
  

    public function addtoTaskMaste($event) {

        //return $event->model->MS_all()->toArray();

        //return "test";
         //   dd(session()->all());

    }


    public function subscribe($events)
    {
        // $events->listen(
        //     'B\NMS\E\MessagePosted',
        //     'B\TMS\E\L\MessageAdded@addtoTaskMaste'
          
        // );

     
    
    }
}
