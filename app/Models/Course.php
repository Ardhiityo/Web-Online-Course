<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function courseBenefits()
    {
        return $this->hasMany(CourseBenefit::class);
    }

    public function courseSections()
    {
        return $this->hasMany(CourseSection::class);
    }

    public function courseMentors()
    {
        return $this->hasMany(CourseMentor::class);
    }
}
