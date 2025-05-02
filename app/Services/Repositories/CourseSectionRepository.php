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

    public function getAllCourseSectionIdByCourseIdToArray(int $courseId): array
    {
        return CourseSection::where('course_id', $courseId)
            ->pluck('id')->toArray();
    }

    public function getCourseSectionById(int $courseSectionId)
    {
        return CourseSection::find($courseSectionId);
    }
}
