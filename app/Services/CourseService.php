<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseStudent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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

    public function getCourseBySlug(string $slug)
    {
        return Course::with(['category', 'courseSections' => ['sectionContents']])
            ->where('slug', $slug)
            ->first()
            ->append(['total_course_section', 'total_section_content']);
    }

    public function studentJoinCourse(string $slug)
    {
        $course = Course::where('slug', $slug)->first();

        $student = Auth::user();

        $studentHasCourse = $student->courses()
            ->wherePivot('course_id', $course->id)
            ->wherePivot('user_id', $student->id)
            ->exists();

        if (!$studentHasCourse) {
            $student->courses()->attach($course->id, ['is_active' => true]);
        }
    }
}
