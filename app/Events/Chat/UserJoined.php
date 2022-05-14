<?php

namespace App\Events\Chat;

use App\Models\Chat\Chat;
use App\Models\Chat\Message\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $chatId;

    public $message;

    public function __construct(Chat $chat, User $user) {
        $this->chatId = $chat->id;

        $this->message = [
            'chat' => $chat->name,
            'user' => $user->name
        ];
    }

    public function broadcastOn()
    {
        return ['chat-' . $this->chatId, new PrivateChannel('chat')];
    }

    public function broadcastAs()
    {
        return 'chat-user-joined';
    }
}
