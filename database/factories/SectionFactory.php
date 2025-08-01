<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(255),
            'status' => $this->faker->boolean(),
            'image' => fake()->imageUrl(640, 480, 'business'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
