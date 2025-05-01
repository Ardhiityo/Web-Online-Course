<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
}
