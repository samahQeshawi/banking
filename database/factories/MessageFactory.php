<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sender_id' => fake()->numberBetween(1, 100),
            'sender_type' => fake()->randomElement(['App\Models\Customer', 'App\Models\Restaurant']),
            'receiver_id' => fake()->numberBetween(1, 100),
            'receiver_type' => fake()->randomElement(['App\Models\Customer', 'App\Models\Restaurant']),
            'body' => fake()->text(255),
            'is_read' => fake()->boolean(),
            'sent_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'firebase_id' => fake()->uuid(), // or fake()->sha1(), to mimic Firebase IDs
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
