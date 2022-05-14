<?php

namespace App\Models\Chat;

use App\Models\User;
use Database\Factories\ChatFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Models\Chat\Message\HasMessages;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory, HasMessages;

    protected $fillable = [
        'name'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /** @noinspection PhpMissingReturnTypeInspection */
    protected static function newFactory()
    {
        return new ChatFactory();
    }
}
