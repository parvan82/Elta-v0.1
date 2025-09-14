<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\ChMessage as Message;
use Chatify\Facades\ChatifyMessenger as Chatify;

class MessageEdited implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_html;
    public $message_id;
    public $to;

    /**
     * Create a new event instance.
     */
    public function __construct(Message $message, int $to)
    {
        // شناسه گیرنده برای نام کانال خصوصی
        $this->to = $to;

        // آی‌دی پیام (برای پیدا کردن در DOM)
        $this->message_id = $message->id;

        // رندر کامل HTML کارت پیام
        $messageData = Chatify::parseMessage($message);
        $this->message_html = Chatify::messageCard($messageData, $message->from_id == auth()->id());
    }

    /**
     * The channel the event should broadcast on.
     */
    public function broadcastOn()
    {
        // private-chatify.{to_id}
        return new PrivateChannel('chatify.' . $this->to);
    }

    /**
     * The event name for client-side listener.
     */
    public function broadcastAs()
    {
        return 'message.edited';
    }

    /**
     * The data to broadcast.
     */
    public function broadcastWith()
    {
        return [
            'message_id'   => $this->message_id,
            'message_html' => $this->message_html,
        ];
    }
}
