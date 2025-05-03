<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CourseService;
use App\Services\CategoryService;

class CourseController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private CategoryService $categoryService
    ) {}

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

        return view("courses.course-details", compact('course'));
    }

    public function successJoin($slug)
    {
        $course = $this->courseService->successJoin($slug);

        return view('success-join', $course);
    }

    public function learning($slug, $courseSectionId, $sectionContentId)
    {
        $learning = $this->courseService->learning(
            $slug,
            $courseSectionId,
            $sectionContentId
        );

        return view('courses.course-learning', $learning);
    }

    public function nextLearning($slug, $courseSectionId, $sectionContentId)
    {
        return $this->courseService->nextLearning(
            $slug,
            $courseSectionId,
            $sectionContentId
        );
    }

    public function learningFinished(string $slug)
    {
        $course = $this->courseService->getCourseDetailBySlug($slug);

        if (!$course) return abort(404);

        return view('courses.course-learning-finished', compact('course'));
    }
}
