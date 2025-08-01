<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'restaurant_id' => fake()->numberBetween(1, 20),
            'menu_id' => fake()->numberBetween(1, 10),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 1, 500),
            'calories' => fake()->numberBetween(50, 1000),
            'featured' => fake()->boolean,
            'image' => fake()->imageUrl(640, 480, 'food'),
            'is_available' => fake()->boolean,
            'status' => fake()->boolean,
            'sort_order' => fake()->numberBetween(1, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
