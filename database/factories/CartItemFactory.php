<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => fake()->randomNumber(1),
            'item_id' => fake()->randomNumber(1),
            'item_name' => $this->faker->text(10),
            'quantity' => fake()->randomNumber(1),
            'price' => fake()->randomFloat(10, 8, 2),
            'item_additions' => json_encode(['key' => 'value']),
            'notes' => fake()->text(255),
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
