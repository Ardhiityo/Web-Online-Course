<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectionContent extends Model
{
    use SoftDeletes;
    public function courseSection()
    {
        return $this->belongsTo(CourseSection::class);
    }
}
