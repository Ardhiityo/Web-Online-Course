<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\PricingService;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function __construct(private CourseService $courseService) {}

    public function index()
    {
        return view("home");
    }

    public function pricing(PricingService $pricingService)
    {
        $pricings = $pricingService->getAllPricing();

        return view("pricing", compact("pricings"));
    }

    public function catalog()
    {
        $courses = $this->courseService->getPopularCourses();

        return view("catalog", compact("courses"));
    }
}
