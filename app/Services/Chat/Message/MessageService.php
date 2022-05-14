<?php

namespace App\Services\Chat\Message;

use App\Models\Chat\Chat;
use App\Services\Chat\ChatService;

class MessageService
{
    public function __construct(private ChatService $chatService) {}

    /** @noinspection PhpParamsInspection */
    public function send(array $data, Chat $chat)
    {
        $message = $chat->messages()->make([
            'content' => data_get($data, 'content'),
            'user_id' => auth()->id(),
            'chat_id' => $chat->id,
        ]);

        $this
            ->chatService
            ->to($chat)
            ->send($message);
    }
}