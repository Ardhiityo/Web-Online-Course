<?php

namespace App\Services\Interfaces;

interface CourseSectionInterface
{
    public function getAllCourseSectionIdByCourseId(int $courseId): array;
    public function getCourseSectionById(int $courseSectionId);
}
