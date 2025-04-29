<?php

namespace App\Http\Controllers;

use App\Models\Pricing;
use Illuminate\Http\Request;
use App\Services\MidtransService;
use App\Services\TransactionService;
use App\Http\Requests\CheckoutStoreRequest;

class TransactionController extends Controller
{
    public function __construct(
        private MidtransService $midtransService,
        private TransactionService $transactionService
    ) {}

    public function checkoutStore(CheckoutStoreRequest $request)
    {
        $data = $request->validated();

        $params = $this->transactionService->createParams($data['pricing_id']);

        return $this->midtransService->getSnapToken($params);
    }

    public function checkoutCallback(Request $request)
    {
        return $this->transactionService->createCallback($request);
    }

    public function checkout(Pricing $pricing)
    {
        return view("transactions.checkout", compact('pricing'));
    }

    public function success($orderId)
    {
        $transaction = $this->transactionService->getTransactionByBookingTrxId($orderId);
        if (is_null($transaction)) return abort(404);

        return view('transactions.success-checkout', compact('transaction'));
    }
}
