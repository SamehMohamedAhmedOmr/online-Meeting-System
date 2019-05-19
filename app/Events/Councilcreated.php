<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Notification;
class Councilcreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $councilname;
    public $id;
    public $title;
    public $d;
    public $message;
    public $page;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($councilname,$id,$title,$page)
    {
         $d=0;
        $this->councilname = $councilname;
        $this->id = $id;
        $this->title = $title;
        $this->message  = $councilname;
        $this->page  = $page;
        $data= new Notification();
        $data->title= $this->title;
        $data->notify= $this->message;
        $data->user_id=$this->id;
        $data->page=$this->page;
        $data->seen=0;
        $data->save();
        $this->d=$data->id;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['council'.$this->id];
    }
}
