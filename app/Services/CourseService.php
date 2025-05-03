<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Category;
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
        $category = Category::where('slug', $slug)->first();

        return Course::with('category')
            ->where('category_id', $category->id)
            ->get()
            ->append(['total_course_section', 'total_section_content']);
    }

    public function getCourseDetailBySlug(string $slug)
    {
        return Course::with(['category', 'courseBenefits', 'courseSections' => ['sectionContents']])
            ->where('slug', $slug)
            ->first()
            ->append(['total_course_section', 'total_section_content']);
    }

    public function getCourseBySlug(string $slug)
    {
        return Course::with(['category', 'courseSections' => ['sectionContents']])
            ->where('slug', $slug)
            ->first();
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

    public function getCourseSectionAndSectionContentById(Course $course, int $courseSectionId, int $sectionContentId)
    {
        $courseSection = $course->courseSections()
            ->find($courseSectionId)
            ->load('sectionContents');

        $sectionContent = $courseSection->sectionContents()
            ->find('id', $sectionContentId);

        return compact('courseSection', 'sectionContent');
    }

    public function successJoin($slug)
    {
        $course = $this->getCourseDetailBySlug($slug);

        if (!$course) return abort(404);

        $this->studentJoinCourse($slug);

        $courseSection = $course->courseSections()->first();

        if (!$courseSection) return abort(404);

        $sectionContent = $courseSection->sectionContents()->first();

        if (!$sectionContent) return abort(404);

        return compact('course', 'courseSection', 'sectionContent');
    }

    public function learning(string $slug, int $courseSectionId, int $sectionContentId)
    {
        $course = $this->getCourseBySlug($slug);

        if (!$course) return abort(404);

        $latestCourseSectionId = $course->courseSections()->latest()->first();

        $section = $course->courseSections()->find($courseSectionId);

        if (!$section) return abort(404);

        $content = $section->sectionContents()->find($sectionContentId);

        if (!$content) return abort(404);

        $latestSectionContentId = $latestCourseSectionId->sectionContents()->latest()->first();

        $sectionContentId == $latestSectionContentId->id ?
            session()->put('completed', true) : session()->put('completed', false);

        return compact('course', 'content');
    }

    public function nextLearning(string $slug, int $courseSectionId, int $sectionContentId)
    {
        //Ambil Course berdasarkan slug parameter
        $course = $this->getCourseBySlug($slug);

        // Ambil course section berdasarkan courseId yang sekarang
        $section = $course->courseSections()->find($courseSectionId);

        // Ambil semua id section content berdasarkan course section id, dan kembalikan dalam kumpulan array
        $allSectionContentId = $section->sectionContents()->pluck('id')->toArray();

        // Cek apakah section content id yang sekarang ada di dalam array kumpulan section content id
        if (in_array($sectionContentId, $allSectionContentId)) {

            // Jika ada, ambil index dari section content id yang sekarang
            $currentIndex = array_search($sectionContentId,  $allSectionContentId);

            // Cek apakah ada section content id selanjutnya
            $nextContentId = $allSectionContentId[$currentIndex + 1] ?? null;

            // Jika ada, ambil section content id selanjutnya
            if ($nextContentId) {
                $content = $section->sectionContents()->find($nextContentId);

                // Jika ada, kembalikan ke halaman kursus dengan section content id selanjutnya
                if ($content) {

                    // Kembalikan ke halaman kursus dengan section content id selanjutnya
                    return redirect()->route('course-learning', [
                        'slug' => $course->slug,
                        'courseSectionId' => $section->id,
                        'sectionContentId' => $content->id
                    ]);
                }
                // Jika tidak ada section konten selanjutnya, cek course section selanjutnya
            } else {
                // Ambil semua course section id berdasarkan course id, dan kembalikan dalam kumpulan array
                $allCourseSectionId = $this->courseSectionInterface
                    ->getAllCourseSectionIdByCourseIdToArray($course->id);

                // Cek apakah course section id yang sekarang ada di dalam array kumpulan course section id
                $currentSectionIndex = array_search($courseSectionId, $allCourseSectionId);

                // Jika ada, ambil index dari course section id yang sekarang
                $nextSectionId = $allCourseSectionId[$currentSectionIndex + 1] ?? null;

                // Jika ada, ambil course section id selanjutnya
                if ($nextSectionId) {
                    // Ambil course section id selanjutnya
                    $section = $this->courseSectionInterface
                        ->getCourseSectionById($nextSectionId);
                    // Ambil section content id pertama dari course section id selanjutnya
                    $content = $this->sectionContentInterface
                        ->getSectionContentByCourseSectionId($section->id);

                    // Jika ada, kembalikan ke halaman kursus dengan section content id pertama dari course section id selanjutnya
                    return redirect()->route('course-learning', [
                        'slug' => $course->slug,
                        'courseSectionId' => $section->id,
                        'sectionContentId' => $content->id
                    ]);
                }
            }
        }

        // Jika tidak ada section selanjutnya, maka kembalikan ke halaman kursus selesai
        return redirect()->route('course-learning-finished', ['slug' => $slug]);
    }
}
