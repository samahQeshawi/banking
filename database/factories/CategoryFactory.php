<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
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
            'image' => $this->faker->imageUrl(),
            'status' => $this->faker->boolean(),
            'created_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
