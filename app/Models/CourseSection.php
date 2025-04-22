<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseSection extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function sectionContents()
    {
        return $this->hasMany(SectionContent::class);
    }
}
