<?php

namespace Database\Factories;

use App\Models\Day;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StartDate>
 */
class StartDateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'available_spaces' => $this->faker->numberBetween(1, 20),
        ];
    }

    public function withDay() {
        return $this->state(function (array $attributes) {
            return [
                'day_id' => Day::all()->random()->id,
            ];
        });
    }

    public function withLocation() {
        return $this->state(function (array $attributes) {
            return [
                'location_id' => Location::all()->random()->id,
            ];
        });
    }

    public function withCourse($course_id) {
        return $this->state(function (array $attributes) use ($course_id) {
            return [
                'course_id' => $course_id,
            ];
        });
    }
}
