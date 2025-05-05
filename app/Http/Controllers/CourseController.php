<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function courseDetails(Course $course)
    {
        $course = $this->courseService->getCourseDetails($course);

        return view("courses.course-details", compact('course'));
    }

    public function successJoin(Course $course)
    {
        $course = $this->courseService->successJoin($course);

        return view('success-join', $course);
    }

    public function learning(Course $course, CourseSection $courseSection, SectionContent $sectionContent)
    {
        $nextLearning = $this->courseService->nextLearning(
            $course,
            $courseSection,
            $sectionContent
        );

        $this->courseService->learningFinished($course, $sectionContent->id);

        $currentLearning = compact('course',  'sectionContent');

        if ($nextLearning) {
            return view('courses.course-learning',  $currentLearning, $nextLearning);
        }

        return view('courses.course-learning', $currentLearning);
    }

    public function learningFinished(Course $course)
    {
        $course = $this->courseService->getCourseDetails($course);

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
