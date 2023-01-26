<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $dateFrom = fake()->dateTimeBetween('+4 days', '+1 month');
        return [
            'room_id' => fake()->numberBetween(1, 5),
            'professor_id' => fake()->numberBetween(1, 5),
            'subject_id' => fake()->numberBetween(1, 5),
            'remarks' => fake()->sentence(10),
            'date_from' => $dateFrom,
            'date_to' => Carbon::parse($dateFrom)->addHours(2),
        ];
    }
}
