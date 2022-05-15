<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\Chat\ChatSeeder;
use Database\Seeders\Shop\ShopSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::first() ?? User::factory()->developer()->create();

        $this->call([
            ChatSeeder::class,
            ShopSeeder::class
        ]);
    }
}
