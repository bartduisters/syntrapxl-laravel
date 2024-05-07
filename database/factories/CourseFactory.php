<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\Person;
use App\Models\Saving;
use App\Models\Sector;
use App\Models\Duration;
use App\Models\KmoTheme;
use App\Models\StartDate;
use App\Models\StudyType;
use App\Models\CourseType;
use App\Models\PriceDetail;
use App\Models\SpecialProperty;
use Illuminate\Support\Facades\Log;
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
        // $table->id();
        // $table->string('url');
        // $table->string('title');
        // $table->text('teaser')->nullable();
        // $table->float('price_excl')->nullable();
        // $table->float('price_incl')->nullable();

        // $table->string('image')->nullable();
        // $table->boolean('is_business')->default(false);
        // $table->text('program_text')->nullable();

        // $table->foreignId('kmo_theme_id')->nullable()->constrained()->cascadeOnDelete();
        // $table->foreignId('sector_id')->constrained()->cascadeOnDelete();
        // $table->foreignId('course_type_id')->constrained()->cascadeOnDelete();
        // $table->foreignId('duration_id')->nullable()->constrained()->cascadeOnDelete();
        // $table->foreignId('level_id')->nullable()->constrained()->cascadeOnDelete();
        // $table->foreignId('study_type_id')->nullable()->constrained()->cascadeOnDelete();

        // $table->text('details_text')->nullable();
        // $table->text('details_extra_info')->nullable();
        // $table->text('details_for_text')->nullable();
        // $table->text('details_requirements_text')->nullable();

        $price_excl = $this->faker->randomFloat(2, 0, 1000);
        $price_incl = $price_excl * 1.21;
        return [
            'url' => $this->faker->url(),
            'title' => $this->faker->sentence(),
            'teaser' => $this->faker->paragraph(),
            'price_excl' => $price_excl,
            'price_incl' => $price_incl,

            'image' => $this->faker->imageUrl(),
            'is_business' => $this->faker->boolean(),
            'program_text' => $this->faker->paragraph(),
        ];
    }

    public function withRandomRelationships(): self
    {
        $amount_of_start_dates = $this->faker->numberBetween(0, 3);
        $random_amount_of_teachers = $this->faker->numberBetween(1, 3);
        return $this->withRandomKmoTheme()
            ->withRandomSector()
            ->withRandomCourseType()
            ->withRandomDuration()
            ->withRandomLevel()
            ->withRandomStudyType()
            ->withPriceDetail()
            ->withStartDates($amount_of_start_dates)
            ->withSpecialProperties()
            ->withRandomBusinessDeveloper()
            ->withRandomTeachers($random_amount_of_teachers)
            ->withRandomSavings();
    }

    public function withRandomKmoTheme(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'kmo_theme_id' => KmoTheme::all()->random()->id,
            ];
        });
    }

    public function withRandomSector(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'sector_id' => Sector::all()->random()->id,
            ];
        });
    }

    public function withRandomCourseType(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'course_type_id' => CourseType::all()->random()->id,
            ];
        });
    }

    public function withRandomDuration(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'duration_id' => Duration::all()->random()->id,
            ];
        });
    }

    public function withRandomLevel(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'level_id' => Level::all()->random()->id,
            ];
        });
    }

    public function withRandomStudyType(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'study_type_id' => StudyType::all()->random()->id,
            ];
        });
    }

    public function withPriceDetail(): self
    {
        return $this->afterCreating(function ($course) {
            PriceDetail::factory()->withCourse($course->id)->create();
        });
    }

public function withStartDates($count = 1): self
    {
        return $this->afterCreating(function ($course) use ($count) {
            for ($i = 0; $i < $count; $i++) {
                StartDate::factory()->withCourse($course->id)->withDay()->withLocation()->create();
            }
        });
    }

    public function withSpecialProperties(): self
    {
        $all_special_property_ids = SpecialProperty::all()->pluck('id');
        $random_count = $this->faker->numberBetween(0, count($all_special_property_ids));
        return $this->afterCreating(function ($course) use ($random_count, $all_special_property_ids) {
            $special_property_ids = $all_special_property_ids->random($random_count);
            $course->specialProperties()->attach($special_property_ids);
        });
    }

    public function withRandomBusinessDeveloper(): self
    {
        return $this->afterCreating(function ($course) {
            $all_business_developer_ids = Person::where('is_business_developer', true)->pluck('id');
            $course->businessDevelopers()->attach($all_business_developer_ids->random());
        });
    }

    public function withRandomTeachers($count = 1): self
    {
        return $this->afterCreating(function ($course) use ($count) {
            $all_teacher_ids = Person::where('is_teacher', true)->pluck('id');
            for ($i = 0; $i < $count; $i++) {
                $course->teachers()->attach($all_teacher_ids->random());
            }
        });
    }

    public function withRandomSavings(): self
    {
        $all_saving_ids = Saving::all()->pluck('id');
        $random_count = $this->faker->numberBetween(0, count($all_saving_ids));
        return $this->afterCreating(function ($course) use ($all_saving_ids, $random_count) {
            $random_ids = $all_saving_ids->random($random_count);
            $course->savings()->attach($random_ids);
        });
    }
}
