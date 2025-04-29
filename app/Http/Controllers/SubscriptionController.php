<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

    public function __construct(private TransactionService $transactionService) {}
    public function mySubscription()
    {
        $studentId = Auth::user()->id;
        $transactions = $this->transactionService->getAllTransactionById($studentId);

        return view('subscriptions.my-subscription', compact('transactions'));
    }

    public function subscriptionDetail(Transaction $transaction)
    {
        $transaction->load('pricing');

        return view('subscriptions.subscription-details', compact('transaction'));
    }
}
