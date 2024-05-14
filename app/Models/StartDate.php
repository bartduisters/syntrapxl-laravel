<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StartDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'location_id',
        'day_id',
        'date',
        'available_spaces',
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
