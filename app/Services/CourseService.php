<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Category;
use App\Models\CourseSection;
use App\Models\SectionContent;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\CourseSectionInterface;
use App\Services\Interfaces\SectionContentInterface;

class CourseService
{
    public function __construct(
        private CourseSectionInterface $courseSectionInterface,
        private SectionContentInterface $sectionContentInterface
    ) {}

    public function getPopularCourses()
    {
        return Course::where("is_popular", true)
            ->take(2)
            ->get()
            ->append(['total_course_section', 'total_section_content']);
    }

    public function getCoursesByCategory(string $slug)
    {
        try {
            $category = Category::where('slug', $slug)->firstOrFail();
            return Course::with('category')
                ->where('category_id', $category->id)
                ->get()
                ->append(['total_course_section', 'total_section_content']);
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function getCourseDetails(Course $course)
    {
        return $course->load(['category', 'courseBenefits', 'courseMentors', 'courseSections' => ['sectionContents']])
            ->append(['total_course_section', 'total_section_content']);
    }

    public function getCourseBySlug(string $slug)
    {
        try {
            return Course::with(['category', 'courseSections' => ['sectionContents']])
                ->where('slug', $slug)
                ->firstOrFail();
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function studentJoinCourse(Course $course)
    {
        $student = Auth::user();

        $studentHasCourse = $student->courses()
            ->wherePivot('course_id', $course->id)
            ->wherePivot('user_id', $student->id)
            ->exists();

        if (!$studentHasCourse) {
            $student->courses()->attach($course->id, ['is_active' => true]);
        }
    }

    public function getCourseSectionAndSectionContentById(Course $course, int $courseSectionId, int $sectionContentId)
    {
        $courseSection = $course->courseSections()
            ->find($courseSectionId)
            ->load('sectionContents');

        $sectionContent = $courseSection->sectionContents()
            ->find('id', $sectionContentId);

        return compact('courseSection', 'sectionContent');
    }

    public function successJoin(Course $course)
    {
        try {
            $this->studentJoinCourse($course);
            $courseSection = $course->courseSections()->firstOrFail();
            $sectionContent = $courseSection->sectionContents()->firstOrFail();

            return compact('course', 'courseSection', 'sectionContent');
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    public function learningFinished(Course $course, $sectionContentId)
    {
        $latestCourseSectionId = $course->courseSections()->latest()->first();

        $latestSectionContentId = $latestCourseSectionId->sectionContents()->latest()->first();

        return $sectionContentId == $latestSectionContentId->id ?
            session()->put('completed', true) : session()->put('completed', false);
    }

    public function nextLearning(Course $course, CourseSection $courseSection, SectionContent $sectionContent)
    {
        $allCourseSectionId = $course->courseSections()->pluck('id')->toArray();

        // Ambil semua id section content berdasarkan course section id, dan kembalikan dalam kumpulan array
        $allSectionContentId = $courseSection->sectionContents()->pluck('id')->toArray();

        // Cek apakah section content id yang sekarang ada di dalam array kumpulan section content id
        if (in_array($sectionContent->id, $allSectionContentId)) {

            // Jika ada, ambil index dari section content id yang sekarang
            $currentIndex = array_search($sectionContent->id,  $allSectionContentId);

            // Cek apakah ada section content id selanjutnya
            $nextContentId = $allSectionContentId[$currentIndex + 1] ?? null;

            // Jika ada, ambil section content id selanjutnya
            if ($nextContentId) {
                try {
                    $content = $courseSection->sectionContents()->findOrFail($nextContentId);
                    $slug = $course->slug;
                    $nextSection = $courseSection->id;
                    $nextContent = $content->id;

                    return compact('slug', 'nextSection', 'nextContent');
                } catch (\Throwable $th) {
                    return abort(404);
                }
            } else {
                // Cek apakah course section id yang sekarang ada di dalam array kumpulan course section id
                $currentSectionIndex = array_search($courseSection->id, $allCourseSectionId);

                // Jika ada, ambil index dari course section id yang sekarang
                $nextSectionId = $allCourseSectionId[$currentSectionIndex + 1] ?? null;

                // Jika ada, ambil course section id selanjutnya
                if ($nextSectionId) {
                    // Ambil course section id selanjutnya
                    $section = $this->courseSectionInterface
                        ->getCourseSectionById($nextSectionId);
                    // Ambil section content id pertama dari course section id selanjutnya
                    $content = $section->sectionContents()->first();

                    $slug = $course->slug;
                    $nextSection = $section->id;
                    $nextContent = $content->id;

                    return compact('slug', 'nextSection', 'nextContent');
                } else {
                    return false;
                }
            }
        }
    }

    public function searchCourse(string $keywords)
    {
        return Course::with('category')->where('name', 'like', "%$keywords%")
            ->orWhere('about', 'like', "%$keywords%")
            ->latest()
            ->get()
            ->append([
                'total_course_section',
                'total_section_content'
            ]);
    }
}
