<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NotificationTemplateFactory extends Factory
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
            'title' => fake()->text(255),
            'body' => fake()->text(255),
            'metadata' => json_encode(['key' => 'value']),
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
