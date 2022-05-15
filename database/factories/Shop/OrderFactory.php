<?php

namespace Database\Factories\Shop;

use App\Models\User;
use App\Models\Shop\Order;
use App\Enums\Shop\OrderStatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function definition(): array
    {
        return [
            'user_id' => User::first()->id,
            'status'  => OrderStatusType::getRandomValue(),
            'address' => json_encode([
                'street'       => 'Podgórska',
                'number'       => '38B',
                'zip_code'     => '31-659',
                'city_name'    => 'Kraków',
                'country_name' => 'Poland',
            ]),
        ];
    }
}
