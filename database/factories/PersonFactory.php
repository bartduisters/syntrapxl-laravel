<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $is_teacher = $this->faker->boolean();
        $is_business_developer = $is_teacher ? false : true;
        return [
            'name' => $this->faker->name(),
            'image' => $this->faker->imageUrl(),
            'is_teacher' => $is_teacher,
            'is_business_developer' => $is_business_developer
        ];
    }

    public function teacher(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_teacher' => true,
                'is_business_developer' => false
            ];
        });
    }

    public function businessDeveloper(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'is_teacher' => false,
                'is_business_developer' => true
            ];
        });
    }
}
