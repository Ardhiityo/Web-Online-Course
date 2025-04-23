<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionContent extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'course_section_id',
        'name',
        'content'
    ];

    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }
}
