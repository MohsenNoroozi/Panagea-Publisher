<?php

namespace App\Events;

use App\Models\Subscriber;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessagePublishedToTopic
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $data;
    public Subscriber $subscriber;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Subscriber $subscriber, array $data)
    {
        $this->data = $data;
        $this->subscriber = $subscriber;
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
}
