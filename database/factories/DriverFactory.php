<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // or Hash::make('password')
            'photo' => $this->faker->imageUrl,
            'vehicle_type' => $this->faker->randomElement(['car', 'motorcycle', 'van']),
            'vehicle_license_plate' => strtoupper($this->faker->bothify('??###??')),
            'is_available' => $this->faker->boolean,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'status' => $this->faker->randomElement(['active', 'inactive', 'suspended']),
            'balance' => $this->faker->randomFloat(2, 0, 10000), // 2 decimal places, range: 0–10,000
            'license_photo' => $this->faker->imageUrl,
            'language' => $this->faker->randomElement(['ar', 'en']),
            'remember_token' => Str::random(10),
            'notification_settings' => [
                'notification_sound' => 'with_sound',
                'notification_channel' => 'in_app',
            ],
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
