<?php

namespace App\Events;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Event;

class MessageReceived extends Event
{
    //use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message;
    private $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $userID)
    {
        $this->message = $message;
        $this->userId = $userID;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }

    public function getData()
    {
        $model = new Message();
        $model->room_id = $this->message->room_id;
        $model->message = $this->message->type == 'text' ? $this->message->content : "";
        $model->image = $this->message->type == 'image' ? $this->message->image : "";
        $model->user_id = $this->userId;
        $model->created_at = Carbon::now();

        return $model;
    }
}
