<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => mt_rand(14, 20),
            'telepon' => mt_rand(100000000000, 900000000000),
            'school_level' => fake()->randomElement(['SMA', 'SMK']),
            'email_verified_at' => now(),
            'password' => bcrypt('123123'), // password
            'image' => 'me.png',
            'remember_token' => Str::random(10),
            'role' => fake()->randomElement(['siswa', 'instruktur'])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
