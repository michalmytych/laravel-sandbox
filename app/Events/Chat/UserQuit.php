<?php

namespace App\Events\Chat;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class UserQuit
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct() {}
}
