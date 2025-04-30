<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Course;

class CourseService
{
    public function getPopularCourses()
    {
        return Course::where("is_popular", true)
            ->take(2)
            ->get()
            ->append(['total_course_section', 'total_section_content']);
    }

    public function getCoursesByCategory(string $slug)
    {
        $category = Category::where('slug', $slug)->first();

        return Course::with('category')
            ->where('category_id', $category->id)
            ->get()
            ->append(['total_course_section', 'total_section_content']);
    }
}
