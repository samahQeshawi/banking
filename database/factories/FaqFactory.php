<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FaqFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'question' => fake()->sentence(6),
            'answer' => fake()->paragraph(3),
            'category' => fake()->word(),
            'language' => fake()->languageCode(),
            'position' => fake()->numberBetween(1, 100),
            'status' => fake()->boolean(),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
