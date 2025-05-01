<?php

namespace App\Http\Controllers;

use App\Models\CourseSection;
use Illuminate\Http\Request;
use App\Models\SectionContent;
use App\Services\CourseService;
use App\Services\PricingService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private CategoryService $categoryService
    ) {}

    public function index()
    {
        return view("home");
    }

    public function pricing(PricingService $pricingService)
    {
        $pricings = $pricingService->getAllPricing();

        return view("pricing", compact("pricings"));
    }

    public function catalog(Request $request)
    {
        if ($slug = $request->query('catalog')) {
            $courses = $this->courseService->getCoursesByCategory($slug);
        } else {
            $category = $this->categoryService->getFirstCategory();
            return redirect()->route('course', ['catalog' => $category->slug]);
        }

        $popularCourses = $this->courseService->getPopularCourses();

        $categories = $this->categoryService->getAllCategories();

        return view("catalog", compact("popularCourses", "categories", "courses"));
    }

    public function courseDetails($slug)
    {
        $course = $this->courseService->getCourseDetailBySlug($slug);

        return view("course-details", compact('course'));
    }

    public function successJoin($slug)
    {
        $course = $this->courseService->getCourseDetailBySlug($slug);

        if (!$course) return abort(404);

        $this->courseService->studentJoinCourse($slug);

        $courseSection = $course->courseSections()->first();

        if (!$courseSection) return abort(404);

        $sectionContent = $courseSection->sectionContents()->first();

        if (!$sectionContent) return abort(404);

        return view('success-join', compact('course', 'courseSection', 'sectionContent'));
    }

    public function learning($slug, $courseSectionId, $sectionContentId)
    {
        $course = $this->courseService->getCourseBySlug($slug);

        if (!$course) return abort(404);

        $section = $course->courseSections()->find($courseSectionId);

        if (!$section) return abort(404);

        $content = $section->sectionContents()->find($sectionContentId);

        if (!$content) return abort(404);

        return view('course-learning', compact('course', 'content'));
    }

    public function nextLearning($slug, $courseSectionId, $sectionContentId)
    {
        //Ambil Course
        $course = $this->courseService->getCourseBySlug($slug);

        // Ambil id dalam course section berdasarkan courseId yang sekarang
        $section = $course->courseSections()->find($courseSectionId);

        // Ambil semua id section content berdasarkan id course section di database
        $allSectionContentId = SectionContent::where('course_section_id', $section->id)
            ->pluck('id')->toArray();

        // Cek id section content pada id section content yang ada
        if (in_array($sectionContentId, $allSectionContentId)) {
            $currentIndex = array_search($sectionContentId, $allSectionContentId);
            $nextContentId = $allSectionContentId[$currentIndex + 1] ?? null;

            if ($nextContentId) {
                $content = $section->sectionContents()->find($nextContentId);

                if ($content) {
                    return redirect()->route('course-learning', [
                        'slug' => $course->slug,
                        'courseSectionId' => $section->id,
                        'sectionContentId' => $content->id
                    ]);
                }
            } else {
                // Jika tidak ada section konten selanjutnya, cek course section selanjutnya
                $allCourseSectionId = CourseSection::where('course_id', $course->id)
                    ->pluck('id')->toArray();

                $currentSectionIndex = array_search($courseSectionId, $allCourseSectionId);
                $nextSectionId = $allCourseSectionId[$currentSectionIndex + 1] ?? null;

                if ($nextSectionId) {
                    $section = CourseSection::find($nextSectionId);
                    $content = SectionContent::where('course_section_id', $section->id)->first();

                    return redirect()->route('course-learning', [
                        'slug' => $course->slug,
                        'courseSectionId' => $section->id,
                        'sectionContentId' => $content->id
                    ]);
                }
            }
        }

        // Jika tidak ada section selanjutnya, kembali ke halaman kursus
        return redirect()->route('course-learning-finished', ['slug' => $slug]);
    }

    public function learningFinished(string $slug)
    {
        $course = $this->courseService->getCourseDetailBySlug($slug);

        if (!$course) return abort(404);

        return view('course-learning-finished', compact('course'));
    }
}
