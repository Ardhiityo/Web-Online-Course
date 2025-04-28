<?php

namespace App\Services;

use Ramsey\Uuid\Uuid;
use App\Models\Pricing;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function __construct(private Transaction $transaction) {}

    public function createParams(int $pricingId)
    {
        $student = Auth::user();
        $pricing = Pricing::find($pricingId);
        $booking_trx_id = (string) Uuid::uuid4();

        $tax = $pricing->price * 0.11; // 11% tax
        $grand_total_amount = $pricing->price + $tax; // price + tax

        return [
            'transaction_details' => [
                'order_id' => $booking_trx_id,
                'gross_amount' => $grand_total_amount,
            ],
            'customer_details' => [
                'first_name' => $student->name,
                'email' => $student->email,
            ],
            'item_details' => [
                [
                    'id' => $booking_trx_id,
                    'price' => $pricing->price,
                    'quantity' => 1,
                    'name' => $pricing->name
                ],
                [
                    'id' => (string) Uuid::uuid4(),
                    'price' => $tax,
                    'quantity' => 1,
                    'name' => 'Tax'
                ],
            ],
            'custom_field1' => $pricing->id,
        ];
    }

    public function createTransaction(string $booking_trx_id, int $pricingId,)
    {
        $student = Auth::user();
        $pricing = Pricing::find($pricingId);
        $sub_total_amount = $pricing->price;
        $tax = $pricing->price * 0.11;
        $grand_total_amount = $pricing->price + $tax;

        return Transaction::create([
            'user_id' => $student->id,
            'booking_trx_id' => $booking_trx_id,
            'pricing_id' => $pricingId,
            'sub_total_amount' => $sub_total_amount,
            'total_tax_amount' => $tax,
            'grand_total_amount' => $grand_total_amount,
            'is_paid' => true,
            'payment_type' => 'midtrans',
            'started_at' => now(),
            'ended_at' => now()->addMonths($pricing->duration),
        ]);
    }

    public function createCallback(Request $request)
    {
        $hashedKey = hash(
            'sha512',
            $request->order_id . $request->status_code . $request->gross_amount . config('midtrans.server_key')
        );

        if ($hashedKey !== $request->signature_key) {
            return response()->json([
                'message' => 'Invalid signature key'
            ], 400);
        }

        $transaction = $request->transaction_status;
        $fraud_status = $request->fraud_status;
        $booking_trx_id = $request->order_id;
        $pricingId = (int)$request->custom_field1;

        if ($transaction === 'capture') {
            if ($fraud_status === 'accept') {
                $this->createTransaction($booking_trx_id, $pricingId);
            }
        } else if ($transaction === 'settlement') {
            $this->createTransaction($booking_trx_id, $pricingId);
        } else {
            return response()->json([
                'message' => 'Invalid transaction status'
            ], 400);
        }

        return response()->json([
            'message' => 'Success'
        ], 200);
    }
}
