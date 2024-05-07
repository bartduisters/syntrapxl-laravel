<?php

namespace Database\Seeders;

use App\Models\Day;
use App\Models\Level;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\Person;
use App\Models\Saving;
use App\Models\Sector;
use App\Models\Duration;
use App\Models\KmoTheme;
use App\Models\Location;
use App\Models\StudyType;
use App\Models\CourseType;
use App\Models\SpecialProperty;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Sector::factory()->count(50)->create();
        CourseType::factory()->count(5)->create();

        $duration_options = [
            '1 dag',
            '1 week',
            '2 weken',
            '1 maand',
            '3 maanden',
            '1 jaar',
            '2 jaar',
        ];
        foreach ($duration_options as $duration_option) {
            Duration::create(['name' => $duration_option]);
        }

        $level_options = [
            'Beginner',
            'Gevorderd',
            'Expert',
        ];
        foreach ($level_options as $level_option) {
            Level::create(['name' => $level_option]);
        }

        StudyType::factory()->count(5)->create();
        KmoTheme::factory()->count(15)->create();

        $saving_options = [
            'kmo',
            'cheques',
            'flemish'
        ];
        foreach ($saving_options as $saving_option) {
            Saving::create(['name' => $saving_option]);
        }

        SpecialProperty::factory()->count(5)->create();

        Person::factory()->count(10)->businessDeveloper()->create();
        Person::factory()->count(70)->teacher()->create();

        $day_options = [
            'maandag',
            'dinsdag',
            'woensdag',
            'donderdag',
            'vrijdag',
            'zaterdag',
        ];
        foreach ($day_options as $day_option) {
            Day::create(['name' => $day_option]);
        }

        Location::factory()->count(5)->create();

        Course::factory()->count(100)->withRandomRelationships()->create();
    }
}
