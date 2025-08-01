<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SubscriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text(50),
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 5, 999),
            'duration' => $this->faker->numberBetween(1, 12), // e.g., months
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
