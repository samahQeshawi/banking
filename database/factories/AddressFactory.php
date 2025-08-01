<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
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
            'latitude' => fake()->latitude(), // e.g., 30.0444
            'longitude' => fake()->longitude(), // e.g., 31.2357
            'building_num' => fake()->buildingNumber(), // e.g., 123
            'building_type' => fake()->randomElement(['Apartment', 'Villa', 'House', 'Duplex']),
            'apartment_num' => fake()->numberBetween(1, 50),
            'floor' => fake()->numberBetween(1, 10),
            'site_name' => fake()->company(), // e.g., "Main Plaza"
            'street' => fake()->streetName(), // e.g., "Sunset Boulevard"
            'additional_info' => fake()->optional()->sentence(),
            'default_address' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),

        ];
    }
}
