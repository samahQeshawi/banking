<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'customer_id' => $this->faker->numberBetween(1, 10),
            'order_id' => $this->faker->numberBetween(1, 10),
            'restaurant_id' => $this->faker->numberBetween(1, 10),
            'driver_id' => $this->faker->numberBetween(1, 10),
            'restaurant_rate' => $this->faker->numberBetween(1, 5),
            'driver_rate' => $this->faker->numberBetween(1, 5),
            'comment' => $this->faker->text(255),
            'created_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTime()->format('Y-m-d H:i:s'),
        ];
    }
}
