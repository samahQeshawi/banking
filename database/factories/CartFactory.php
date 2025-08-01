<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => fake()->randomNumber(1),
            'restaurant_id' => fake()->randomNumber(1),
            'coupon_id' => fake()->randomNumber(1),
            'order_id' => fake()->randomNumber(1),
            'subtotal' => fake()->lexify('?'),
            'total' => fake()->lexify('?'),
            'notes' => fake()->text(255),
            'created_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
