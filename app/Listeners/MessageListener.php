<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class MessageListener extends Event
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $message = $event->getData();
        Log::info(__CLASS__ . ":处理数据，".$message->toArray());
        if ($message && $message->user_id && $message->room_id && ($message->message || $message->image)) {
            $message->save();
            Log::info(__CLASS__ . "数据处理完毕");
        }else{
            Log::info(__CLASS__ . "数据处理失败");
        }
    }
}
