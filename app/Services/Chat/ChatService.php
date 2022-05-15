<?php

namespace App\Services\Chat;

use App\Models\User;
use App\Models\Chat\Chat;
use App\Events\Chat\UserQuit;
use App\Events\Chat\UserJoined;
use App\Events\Chat\ChatCreated;
use App\Models\Chat\Message\Message;
use App\Events\Chat\Message\MessageSent;
use App\Exceptions\Chat\ReceiverNotSpecifiedException;

class ChatService
{
    private ?Chat $receiver = null;

    public function to($receiver): self
    {
        $this->receiver = $receiver;

        return $this;
    }

    public function create(array $data): void
    {
        $chat = Chat::create([
            'user_id' => auth()->id(),
            'name' => $data
        ]);

        ChatCreated::dispatch($chat);
    }

    public function joinChat(User $user): void
    {
        $this->checkReceiver();

        $user->chats()->save($this->receiver);

        UserJoined::dispatch($this->receiver, $user);
    }

    public function quitChat(User $user): void
    {
        $this->checkReceiver();

        $user->chats()->save($this->receiver);

        UserQuit::dispatch($this->receiver, $user);
    }

    public function send(Message $message): void
    {
        $this->checkReceiver();

        event(new MessageSent($message, $this->receiver));
    }

    /**
     * @throws ReceiverNotSpecifiedException
     */
    public function checkReceiver(): void
    {
        if (!$this->receiver) {
            throw new ReceiverNotSpecifiedException();
        }
    }
}
