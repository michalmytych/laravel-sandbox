<?php

namespace Database\Factories;

use App\Models\Chat\Chat;
use App\Models\Chat\Message\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    use WithFaker;

    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => $this->faker->sentence(),
            'user_id' => User::first()->id,
            'chat_id' => Chat::first()->id,
        ];
    }
}
