<?php

namespace App\Http\Controllers\Chat\Message;

use App\Models\Chat\Chat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat\Message\Message;
use App\Services\Chat\ChatService;

class MessageController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function findByChat(Chat $chat)
    {
        return Message::whereBelongsTo($chat)->get();
    }

    public function send(Request $request, Chat $chat)
    {
        $message = $chat->messages()->make([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'chat_id' => $chat->id
        ]);

        $this
            ->chatService
            ->to($chat)
            ->send($message);

        return redirect()->to(route('chat.enter', $chat));
    }
}
