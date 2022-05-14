<?php

namespace App\Traits\Models\Chat\Message;

use App\Models\Chat\Message\Message;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasMessages
{
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
