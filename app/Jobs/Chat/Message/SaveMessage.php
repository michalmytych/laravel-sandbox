<?php

namespace App\Jobs\Chat\Message;

use App\Models\Chat\Chat;
use Illuminate\Bus\Queueable;
use App\Models\Chat\Message\Message;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $receiver, public Message $message) {}

    public function handle()
    {
        if ($this->receiver instanceof Chat) {
            $this
                ->receiver
                ->users
                ->each(fn($user) => $user
                    ->messages()
                    ->save($this->message)
            );
        }
    }
}
