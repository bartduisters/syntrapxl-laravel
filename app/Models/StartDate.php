<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartDate extends Model
{
    use HasFactory;

      protected $fillable = [
        'date',
        'course_id',
        'day_id',
        'location_id',
        'available_spaces'
    ];
}
