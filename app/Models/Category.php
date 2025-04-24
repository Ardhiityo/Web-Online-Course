<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'photo',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => [
                'name' => $value,
                'slug' => Str::slug($value),
            ],
        );
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
