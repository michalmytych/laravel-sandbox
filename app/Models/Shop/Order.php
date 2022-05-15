<?php

namespace App\Models\Shop;

use App\Enums\Shop\OrderStatusType;
use App\Traits\Models\BelongsToUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory, BelongsToUser;

    protected $fillable = [
        'address',
        'status'
    ];

    protected $casts = [
        'status' => OrderStatusType::class
    ];

    public function products(): BelongsToMany
    {
        return $this
            ->belongsToMany(Product::class)
            ->withPivot('quantity');
    }
}
