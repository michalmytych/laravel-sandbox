<?php

namespace App\Events\Chat\Message;

use App\Models\Chat\Chat;
use App\Models\Chat\Message\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Support\Facades\Log;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;

    public array $message;

    public function __construct(Message $message, Chat $chat)
    {
        $this->chatId = $chat->id;

        $this->message = [
            'message'    => $message->content,
            'author'     => $message->author->name,
            'chat'       => $chat->name,
            'channel'    => 'chat-' . $this->chatId,
            'created_at' => now(),
        ];

        Log::channel('daily')->info('Message sent, id: ' . $message->id);
    }

    public function broadcastOn()
    {
        return ['chat-' . $this->chatId];
    }

    public function broadcastAs()
    {
        return 'chat-message';
    }
}
