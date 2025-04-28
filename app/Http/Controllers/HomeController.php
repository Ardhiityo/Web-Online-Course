<?php

namespace App\Http\Controllers;

use App\Services\PricingService;

class HomeController extends Controller
{
    public function __construct() {}

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
