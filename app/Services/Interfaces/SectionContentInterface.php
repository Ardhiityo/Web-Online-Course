<?php

namespace App\Services\Interfaces;

interface SectionContentInterface
{
    public function getSectionContentByCourseSectionId(int $course_section_id);
}
