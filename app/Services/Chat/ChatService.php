<?php

namespace App\Services\Chat;

use App\Models\Chat\Chat;
use App\Models\Chat\Message\Message;
use App\Jobs\Chat\Message\SaveMessage;
use App\Exceptions\Chat\ReceiverNotSpecifiedException;
use App\Models\User;
use App\Events\Chat\ChatCreated;
use App\Events\Chat\Message\MessageSent;
use App\Events\Chat\UserJoined;
use App\Events\Chat\UserQuit;

class ChatService
{
    private ?Chat $receiver = null;

    public function to($receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function create(array $data)
    {
        $chat = Chat::create([
            'user_id' => auth()->id(),
            'name' => $data
        ]);

        ChatCreated::dispatch($chat);
    }

    public function joinChat(User $user)
    {
        $this->checkReceiver();

        $user->chats()->save($this->receiver);

        UserJoined::dispatch($this->receiver, $user);
    }

    public function quitChat(User $user)
    {
        $this->checkReceiver();

        $user->chats()->save($this->receiver);

        UserQuit::dispatch($this->receiver, $user);
    }

    public function send(Message $message)
    {
        $this->checkReceiver();

        // SaveMessage::dispatch($this->receiver, $message);

        event(new MessageSent($message, $this->receiver));
    }

    public function checkReceiver()
    {
        if (!$this->receiver) {
            throw new ReceiverNotSpecifiedException();
        }
    }
}
