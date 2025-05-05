<?php

namespace App\Http\Controllers;

use App\Services\CourseService;
use App\Services\PricingService;
use App\Services\CategoryService;
use App\Services\TransactionService;

class HomeController extends Controller
{
    public function __construct(
        private CourseService $courseService,
        private CategoryService $categoryService,
        private TransactionService $transactionService,
        private PricingService $pricingService
    ) {}

    public function index()
    {
        return view("home");
    }

    public function pricing()
    {
        $pricings = $this->pricingService->getAllPricing();
        $hasMembership = $this->transactionService->hasMembership();

        return view("pricing", compact("pricings", "hasMembership"));
    }
}
