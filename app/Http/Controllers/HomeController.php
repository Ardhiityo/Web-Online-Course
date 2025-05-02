<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\PricingService;
use App\Services\CategoryService;

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
}
