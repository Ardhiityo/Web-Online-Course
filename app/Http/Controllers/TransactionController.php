<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function checkoutStore(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = config('midtrans.is_sanitized');
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = config('midtrans.is_3ds');

        $pricing_id = $request->pricing_id;
        $pricing = Pricing::find((int)$pricing_id);

        $tax = $pricing->price * 0.11;
        $total = $pricing->price + $tax;

        $transaction = Transaction::create([
            'user_id' => Auth::user()->id,
            'pricing_id' => (int)$pricing_id,
            'sub_total_amount' => $pricing->price,
            'total_tax_amount' => $tax,
            'grand_total_amount' => $total,
            'payment_type' => 'midtrans',
            'started_at' => now(),
            'ended_at' => now()->addMonths($pricing->duration),
        ]);

        $params = [
            'transaction_details' => [
                'order_id' => $transaction->booking_trx_id,
                'gross_amount' => $transaction->grand_total_amount,
            ],
            'customer_details' => [
                'first_name'    => Auth::user()->name,
                'email'         => Auth::user()->email
            ],
            'item_details' => [
                [
                    'id' => $transaction->booking_trx_id,
                    'price' => $transaction->grand_total_amount,
                    'quantity' => 1,
                    'name' => $pricing->name,
                ]
            ]
        ];

        try {
            $redirectUrl = Snap::createTransaction($params)->redirect_url;
            return redirect(to: $redirectUrl);
        } catch (\Throwable $th) {
            return 'Ups, something wrong! : ' . $th->getMessage();
        }
    }

    public function checkout(Pricing $pricing)
    {
        return view("transactions.checkout", compact('pricing'));
    }

    public function success()
    {
        return view('transactions.success-checkout');
    }
}
