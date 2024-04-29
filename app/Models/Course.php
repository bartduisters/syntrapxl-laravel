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
}
