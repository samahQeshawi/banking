<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'notifiable_id' => $this->faker->numberBetween(1, 100),
            'notifiable_type' => $this->faker->randomElement(['App\\Models\\User', 'App\\Models\\Admin']),
            'options' => ['type' => $this->faker->word()],
            'data' => ['message' => $this->faker->sentence()],
            'read_at' => $this->faker->optional()->dateTime(),
            'sent_at' => $this->faker->optional()->dateTime(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
