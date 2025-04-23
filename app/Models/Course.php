<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected function name(): Attribute
    {
        return Attribute::make(
            set: function ($value) {
                return [
                    'name' => $value,
                    'slug' => Str::slug($value),
                ];
            }
        );
    }

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
