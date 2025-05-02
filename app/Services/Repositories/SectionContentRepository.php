<?php

namespace App\Services\Repositories;

use App\Models\SectionContent;
use App\Services\Interfaces\SectionContentInterface;

class SectionContentRepository implements SectionContentInterface
{
    public function __construct()
    {
        //
    }

    public function getSectionContentByCourseSectionId(int $courseSectionId)
    {
        return SectionContent::where("course_section_id", $courseSectionId)->first();
    }
}
