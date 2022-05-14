<?php

namespace App\Traits\Models\Chat;

use App\Models\Chat\Chat;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasChats
{
    public function chats(): HasMany
    {
        return $this->hasMany(Chat::class);
    }
}
