<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderTimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->text(255),
            'status' => fake()->boolean,
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
