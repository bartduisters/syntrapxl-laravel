<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }

    public function formattedDate()
    {
        $date = Carbon::parse($this->date);
        return $date->format("d-m-'y, H\\ui");
    }
}
