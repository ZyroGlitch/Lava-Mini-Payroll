<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;

class DataInserted implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets;

    public $data;

    /**
     * Create a new event instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function broadcastOn()
    {
        return [
            new Channel('data-channel'),
        ];
    }

    public function broadcastAs()
    {
        return 'data.inserted';
    }

}
