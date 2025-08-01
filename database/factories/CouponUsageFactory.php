<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CouponUsageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => fake()->numberBetween(1, 100),
            'coupon_id' => fake()->numberBetween(1, 50),
            'order_id' => fake()->numberBetween(1, 1000),
            'usage_count' => fake()->numberBetween(1, 5),
            'created_at' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'updated_at' => fake()->dateTimeBetween('-1 week', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
