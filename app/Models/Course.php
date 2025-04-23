<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'category_id',
        'is_popular'
    ];

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

    public function courseStudents()
    {
        return $this->hasMany(CourseStudent::class);
    }
}
