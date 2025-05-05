<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Services\PricingService;
use App\Services\CategoryService;
use App\Services\MidtransService;
use App\Services\TransactionService;
use App\Http\Requests\CheckoutStoreRequest;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    public function __construct(
        private MidtransService $midtransService,
        private TransactionService $transactionService,
        private CategoryService $categoryService,
        private PricingService $pricingService,
    ) {}

    public function checkoutStore(CheckoutStoreRequest $request)
    {
        $data = $request->validated();

        $params = $this->transactionService->createParams($data['pricing_id']);

        Session::put('pricing_id', $data['pricing_id']);

        return $this->midtransService->getSnapToken($params);
    }

    public function checkoutCallback(Request $request)
    {
        return $this->transactionService->createCallback($request);
    }

    public function checkout(Pricing $pricing)
    {
        $hasMembership = $this->transactionService->hasMembership();

        return view("transactions.checkout", compact('pricing', 'hasMembership'));
    }

    public function success()
    {
        $pricingId = Session::get('pricing_id');

        $pricing = $this->pricingService->getPricingById($pricingId);

        if (is_null($pricing)) return abort(404);

        $slug = $this->categoryService->getFirstCategory()->slug;

        return view('transactions.success-checkout', compact('pricing', 'slug'));
    }
}
