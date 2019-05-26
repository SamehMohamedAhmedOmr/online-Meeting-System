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
    public $title_ar;

    public $d;
    public $message;
    public $message_ar;

    public $page;
    public $icon;
    public $color;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($councilname,$id,$title,$message,$title_ar,$message_ar,$page,$icon,$color)
    {
         $d=0;
        $this->councilname = $councilname;
        $this->id = $id;

        $this->title = $title;
        $this->title_ar = $title_ar;

        $this->message  = $message;
        $this->message_ar  = $message_ar;

        $this->page = url($page);
        $this->icon  = $icon;
        $this->color = $color;

        $data= new Notification();
        $data->title_ar= $this->title_ar;
        $data->notify_ar= $this->message_ar;

        $data->title= $this->title;
        $data->notify= $this->message;

        $data->user_id=$this->id;
        $data->page=$this->page;
        $data->seen=0;
        $data->icon = $icon;
        $data->color = $this->color;

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
