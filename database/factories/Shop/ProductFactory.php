<?php

namespace Database\Factories\Shop;

use App\Models\Shop\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /** @noinspection PhpArrayShapeAttributeCanBeAddedInspection */
    public function definition(): array
    {
        return [
            'name'     => $this->faker->sentence(3),
            'symbol'   => $this->faker->word() . $this->faker->randomNumber(5),
            'ean_code' => $this->faker->ean13(),
        ];
    }
}
