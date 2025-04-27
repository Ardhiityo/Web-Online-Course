<?php

namespace App\Services\Repository;

use App\Models\Pricing;
use App\Services\Interface\PricingService;

class PricingRepository implements PricingService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getAllPricing()
    {
        return Pricing::select('id', 'name', 'duration', 'price')->take(2)->get();
    }
}
