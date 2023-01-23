<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'professor_id' => fake()->randomNumber(1, 5),
            'subject' => fake()->word(),
            'description' => fake()->text(150),
            'units' => fake()->randomNumber(1, 4)
        ];
    }
}
