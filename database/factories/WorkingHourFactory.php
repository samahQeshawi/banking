<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $openTime = fake()->time('H:i:s');
        $closeTime = Carbon::createFromFormat('H:i:s', $openTime)->addHours(rand(1, 5))->format('H:i:s');

        return [
            'restaurant_id' => Restaurant::inRandomOrder()->first()?->id ?? Restaurant::factory(),
            'day_of_week' => fake()->randomElement([
                'saturday', 'sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday',
            ]),
            'open_time' => $openTime,
            'close_time' => $closeTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
