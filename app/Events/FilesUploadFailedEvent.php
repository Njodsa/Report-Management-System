<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class FilesUploadFailedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $report;
    public $email;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($report,$email)
    {
      $this->report = $report;
      $this->email  = $email;
    }
}
