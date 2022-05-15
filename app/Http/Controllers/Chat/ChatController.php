<?php

namespace App\Http\Controllers\Chat;

use App\Models\Chat\Chat;
use Illuminate\View\View;
use App\Services\Chat\ChatService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Chat\CreateRequest;

class ChatController extends Controller
{
    public function __construct(private ChatService $chatService) { }

    public function index(): View
    {
        $chats = $this->chatService->all();

        return view('chat.index', ['chats' => $chats]);
    }

    public function create(CreateRequest $request): RedirectResponse
    {
        $this->chatService->create($request->validated());

        return redirect()->to(route('chat.enter'));
    }

    /** @noinspection PhpParamsInspection */
    public function enter(Chat $chat): View
    {
        $this->chatService->to($chat)->joinChat(auth()->user());

        return view('chat.enter', [
            'chat' => $chat->with(
                ['messages' => fn($builder) => $builder->latest()]
            )->get()->first(),
        ]);
    }

    /** @noinspection PhpParamsInspection */
    public function quit(Chat $chat): RedirectResponse
    {
        $user = auth()->user();

        $this->chatService->to($chat)->quitChat($user);

        return redirect()->to('chat.index');
    }
}
