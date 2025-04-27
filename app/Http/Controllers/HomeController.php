<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\Interface\PricingService;

class HomeController extends Controller
{
    public function __construct(private PricingService $pricingService) {}

    public function index()
    {
        return view("home");
    }

    public function pricing()
    {
        $pricings = $this->pricingService->getAllPricing();

        return view("pricing", compact("pricings"));
    }
}
