<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $gender = fake()->randomElement(['Male','Female']);

        return [
            'first_name' => fake()->firstName(strtolower($gender)),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'gender' => $gender,
            'contact' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email' => fake()->email()
        ];
    }
}
