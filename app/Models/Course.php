<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'teaser',
        'price_excl',
        'price_incl',
        // should_show_your_locations
        'image',
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

    public function priceDetails()
    {
        return $this->hasMany(PriceDetail::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'course_person');
    }

    public function kmoTheme()
    {
        return $this->belongsTo(KmoTheme::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function studyType()
    {
        return $this->belongsTo(StudyType::class);
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
