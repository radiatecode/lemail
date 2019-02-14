<?php

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $user;
    public $pid;

    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $user
     */
    public function __construct(Message $message,$user,$pid)
    {
        $this->message = $message;
        $this->user = $user;
        $this->pid = $pid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->user);
    }

    public function broadcastWith(){
        return [
            'message_id'=>$this->message->id,
            'subject'=>substr($this->message->subject,0,20).".....",
            'message'=>substr(strip_tags(html_entity_decode($this->message->message)),0,20).".....",
            'created_at'=>''.$this->message->created_at,
            'receiver_pid'=>$this->pid,
            'sent_by'=>$this->message->sender->user->name
        ];
    }

}
