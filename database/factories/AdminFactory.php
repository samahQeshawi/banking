<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->text(255),
            'phone' => fake()->text(255),
            'email' => fake()->text(255),
            'password' => fake()->text(255),
            'otp' => fake()->text(255),
            'is_verified' => fake()->boolean,
            'image' => fake()->text(255),
            'status' => fake()->boolean,
            'remember_token' => fake()->text(100),
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
