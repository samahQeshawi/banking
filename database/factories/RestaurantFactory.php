<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1, 50),
            'name' => fake()->company(),
            'category_id' => fake()->numberBetween(1, 10),
            'section_id' => fake()->numberBetween(1, 5),
            'iban' => fake()->iban(null),
            'logo' => fake()->imageUrl(300, 300, 'food', true, 'Restaurant'),
            'order_type' => fake()->randomElement(['scheduled', 'current']),
            'location' => fake()->address(),
            'description' => fake()->paragraph(),
            'has_driver' => fake()->boolean(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'status' => fake()->boolean(),
            'activity' => fake()->boolean(),
            'is_suggested' => fake()->boolean(),
            'is_featured' => fake()->boolean(),
            'free_delivery_min_amount' => fake()->numberBetween(200, 300),
            'extra_discount_min_amount' => fake()->numberBetween(200, 300),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
