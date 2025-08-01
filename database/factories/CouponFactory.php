<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'uuid' => (string) Str::uuid(),
            'code' => strtoupper(fake()->unique()->bothify('COUPON-####')),
            'description' => fake()->sentence(),
            'discount_amount' => fake()->randomFloat(2, 1, 100),
            'discount_type' => fake()->randomElement(['fixed', 'percentage']),
            'start_date' => fake()->dateTimeBetween('-1 month', 'now')->format('Y-m-d H:i:s'),
            'end_date' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            'status' => fake()->boolean(),
            'usage_limit' => fake()->numberBetween(1, 100),
            'usage_limit_per_user' => fake()->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
