<?php

namespace App\Services\Interfaces;

interface CourseSectionInterface
{
    public function getAllCourseSectionIdByCourseIdToArray(int $courseId): array;
    public function getCourseSectionById(int $courseSectionId);
}
