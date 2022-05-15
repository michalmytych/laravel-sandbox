<?php

namespace App\Events\Chat;

use App\Models\User;
use App\Models\Chat\Chat;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $chatId;

    public array $message;

    public function __construct(Chat $chat, User $user) {
        $this->chatId = $chat->id;
        $this->message = [
            'chat' => $chat->name,
            'user' => $user->name
        ];
    }

    public function broadcastOn(): array
    {
        return ['chat-' . $this->chatId, new PrivateChannel('chat')];
    }

    public function broadcastAs(): string
    {
        return 'chat-user-joined';
    }
}
