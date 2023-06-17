<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_category' => mt_rand(1, 10),
            'title' => fake()->sentence(mt_rand(1, 3)),
            'description' => fake()->paragraph(),
            'image' => fake()->randomElement(['factory1.png', 'factory2.jpg'])
        ];
    }
}
