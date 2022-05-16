<?php

namespace Database\Seeders;

use App\Models\Chat\Chat;
use App\Models\Cache\Location;
use App\Models\Chat\Message\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $user = User::first() ?? User::factory()->developer()->create();

        Chat::factory()->createMany([
            ['name' => 'Big Chatz', 'user_id' => $user->id],
            ['name' => 'Shawty Chat', 'user_id' => $user->id],
            ['name' => 'Le Chatt', 'user_id' => $user->id],
            ['name' => 'Chatsy', 'user_id' => $user->id],
            ['name' => 'Chatty Chat', 'user_id' => $user->id]
        ]);

        Message::factory(3)->create();

        Location::factory(300)->create();
    }
}
