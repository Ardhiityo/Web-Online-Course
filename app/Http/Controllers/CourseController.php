<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseSection;
use App\Models\SectionContent;
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
            return redirect()->route('course.index', ['catalog' => $category->slug]);
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

    public function learning($slug, CourseSection $courseSection, SectionContent $sectionContent)
    {
        $learning = $this->courseService->learning(
            $slug,
            $courseSection,
            $sectionContent
        );

        $nextLearning = $this->courseService->nextLearning(
            $slug,
            $courseSection,
            $sectionContent
        );

        $this->courseService->learningFinished($slug, $sectionContent->id);

        if ($nextLearning) {
            return view('courses.course-learning', $learning, $nextLearning);
        }

        return view('courses.course-learning', $learning);
    }

    public function learningFinished(string $slug)
    {
        $course = $this->courseService->getCourseDetailBySlug($slug);

        return view('courses.course-learning-finished', compact('course'));
    }

    public function search(Request $request)
    {
        if ($keywords = $request->query('keywords')) {
            $courses = $this->courseService->searchCourse($keywords);
        } else {
            $courses = $this->courseService->searchCourse('');
        }

        return view('search-course', compact('courses'));
    }
}
