<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }
}
