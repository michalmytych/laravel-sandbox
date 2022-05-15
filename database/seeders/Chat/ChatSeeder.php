<?php

namespace Database\Seeders\Chat;

use App\Models\User;
use App\Models\Chat\Chat;
use Illuminate\Database\Seeder;
use App\Models\Chat\Message\Message;

class ChatSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        Chat::factory()->createMany([
            ['name' => 'Big Chatz', 'user_id' => $user->id],
            ['name' => 'Shawty Chat', 'user_id' => $user->id],
            ['name' => 'Le Chatt', 'user_id' => $user->id],
            ['name' => 'Chatsy', 'user_id' => $user->id],
            ['name' => 'Chatty Chat', 'user_id' => $user->id],
        ]);

        Message::factory(3)->create();
    }
}
