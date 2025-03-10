<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'age' => fake()->numberBetween(1, 100),
            'gender' => fake()->numberBetween(0, 1) ? "F" : "M",
            'degree' => fake()->title(),
            'phone' => fake()->phoneNumber(),
        ];
    }
}
