<?php

namespace App\Http\Controllers\Chat\Message;

use App\Models\Chat\Chat;
use App\Http\Controllers\Controller;
use App\Services\Chat\Message\MessageService;
use App\Http\Requests\Chat\Message\SendRequest;

class MessageController extends Controller
{
    public function __construct(private MessageService $messageService) {}

    public function send(SendRequest $request, Chat $chat): void
    {
        $this->messageService->send($request->validated(), $chat);
    }
}
