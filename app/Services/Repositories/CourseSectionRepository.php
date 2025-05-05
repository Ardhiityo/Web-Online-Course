<?php

namespace App\Services\Repositories;

use App\Models\CourseSection;
use App\Services\Interfaces\CourseSectionInterface;

class CourseSectionRepository implements CourseSectionInterface
{
    public function __construct()
    {
        //
    }

    public function getAllCourseSectionIdByCourseId(int $courseId): array
    {
        return CourseSection::where('course_id', $courseId)
            ->pluck('id')->toArray();
    }

    public function getCourseSectionById(int $courseSectionId)
    {
        try {
            return CourseSection::findOrFail($courseSectionId);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }
}
