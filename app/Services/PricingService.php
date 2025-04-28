<?php

namespace App\Services;

use App\Models\Pricing;

class PricingService
{
    public function getAllPricing()
    {
        return Pricing::select('id', 'name', 'duration', 'price')
            ->take(2)
            ->get();
    }
}
