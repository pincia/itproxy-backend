<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewData  implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
 public $eventData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
         echo "event constructor\n";
        //
        $this->eventData =$data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
      public function broadcastAs()
{
     echo "broadcast as CALLED\n";
    return 'drumdata';
}
    public function broadcastOn()
    {
        
        return new PrivateChannel('pippo');
    }
}
