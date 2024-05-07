<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'teaser',
        'price_excl',

        'media_url',
        'is_business',
        'program_text',

        'kmo_theme_id',
        'sector_id',
        'course_type_id',
        'duration_id',
        'level_id',
        'study_type_id',

        'details_text',
        'details_extra_info',
        'details_for_text',
        'details_requirements_text',
    ];

    public function savings()
    {
        return $this->belongsToMany(Saving::class);
    }

    public function specialProperties()
    {
        return $this->belongsToMany(SpecialProperty::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class);
    }

    public function startDates()
    {
        return $this->hasMany(StartDate::class);
    }

    public function businessDevelopers()
    {
        return $this->belongsToMany(Person::class)->where('is_business_developer', true);
    }

    public function teachers()
    {
        return $this->belongsToMany(Person::class)->where('is_teacher', true);
    }
}
