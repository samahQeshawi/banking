<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BannerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'image' => fake()->imageUrl(640, 480, 'business'),
            'title' => fake()->sentence(6),
            'description' => fake()->paragraph(),
            'link' => fake()->url(),
            'view' => fake()->numberBetween(0, 9999),
            'status' => fake()->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
