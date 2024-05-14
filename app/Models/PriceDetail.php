<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'name',
        'price_excl',
        'price_incl',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
