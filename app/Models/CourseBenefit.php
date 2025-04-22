<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseBenefit extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
