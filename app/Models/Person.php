<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'is_teacher', 'is_business_developer'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
