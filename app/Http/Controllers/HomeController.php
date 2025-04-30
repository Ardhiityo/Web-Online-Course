<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\CourseService;
use App\Services\PricingService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(private CourseService $courseService, private CategoryService $categoryService) {}

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
        if ($slug = $request->query('category')) {
            $courses = $this->courseService->getCoursesByCategory($slug);
        } else {
            $category = $this->categoryService->getFirstCategory();
            return redirect()->route('catalog', ['category' => $category->slug]);
        }

        $popularCourses = $this->courseService->getPopularCourses();
        $categories = $this->categoryService->getAllCategories();

        return view("catalog", compact("popularCourses", "categories", "courses"));
    }
}
