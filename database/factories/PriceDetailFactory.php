<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PriceDetail>
 */
class PriceDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $price_excl = $this->faker->randomFloat(2, 0, 1000);
        $price_incl = $price_excl * 1.21;
        return [
            'name' => $this->faker->word(),
            'price_excl' => $price_excl,
            'price_incl' => $price_incl
        ];
    }

    public function withCourse($courseId)
    {
        return $this->state(fn (array $attributes) => ['course_id' => $courseId]);
    }
}
