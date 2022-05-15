<?php

namespace Database\Seeders\Shop;

use App\Models\Shop\Order;
use App\Models\Shop\Product;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(5)
            ->create()
            ->map(function ($product) {
                $idsWithPivotValues = Order::factory(5)
                    ->create()
                    ->pluck('id')
                    ->mapWithKeys(fn($id) => [
                        $id => [
                            'quantity' => random_int(1, 5)
                        ],
                    ]);

                $product->orders()->sync($idsWithPivotValues);
            });
    }
}
