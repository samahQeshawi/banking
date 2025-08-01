<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->unique()->phoneNumber(),
            'password' => bcrypt('password'), // or use Hash::make('password')
            'photo' => fake()->imageUrl(640, 480, 'people'),
            'otp' => fake()->numerify('######'),
            'is_verified' => fake()->boolean(),
            'fcm_token' => fake()->uuid(),
            'api_token' => fake()->regexify('[A-Za-z0-9]{80}'),
            'email_verified_at' => fake()->optional()->dateTime()->format('Y-m-d H:i:s'),
            'language' => fake()->randomElement(['ar', 'en']),
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
