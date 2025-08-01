<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid(),
            'customer_id' => fake()->numberBetween(1, 1000),
            'restaurant_id' => fake()->numberBetween(1, 100),
            'address_id' => fake()->numberBetween(1, 1000),
            'coupon_id' => fake()->optional()->numberBetween(1, 50),
            'driver_id' => null,
            'order_details' => json_encode([
                'items' => [
                    ['name' => 'Burger', 'qty' => 2, 'price' => 50],
                    ['name' => 'Fries', 'qty' => 1, 'price' => 20],
                ],
                'delivery_fee' => 10,
            ]),
            'payment_type' => fake()->randomElement(['cash', 'card', 'online']),
            'discount' => fake()->randomFloat(2, 0, 50),
            'total' => fake()->randomFloat(2, 20, 500),
            'sub_total' => fake()->randomFloat(2, 20, 500),
            'delivery_fees' => fake()->randomFloat(2, 20, 500),
            'status' => fake()->randomElement(['pending', 'confirmed', 'delivered', 'cancelled']),
            'order_method' => fake()->randomElement(['app', 'phone', 'in_person']),
            'cancel_reason' => fake()->optional()->sentence(),
            'is_read_it' => fake()->boolean(),
            'note' => fake()->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
