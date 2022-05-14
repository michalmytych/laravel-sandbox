<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat\Chat;
use App\Http\Controllers\Controller;
use App\Services\Chat\ChatService;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) {}

    public function index()
    {
        $chats = Chat::all();

        return view('chat.index', ['chats' => $chats]);
    }

    public function create(Request $request)
    {
        $this->chatService->create($request->all());

        return redirect()->to(route('chat.enter'));
    }

    public function enter(Chat $chat)
    {
        $user = auth()->user();

        $this->chatService->to($chat)->joinChat($user);

        return view('chat.enter', [
            'chat' => $chat->load('messages')
        ]);
    }

    public function quit(Chat $chat)
    {
        $user = auth()->user();

        $this->chatService->to($chat)->quitChat($user);

        return redirect()->to('chat.index');
    }
}
