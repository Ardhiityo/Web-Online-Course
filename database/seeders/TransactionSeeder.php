<?php

namespace Database\Seeders;

use App\Models\Pricing;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'aryaadi229@gmail.com')->first();

        Transaction::create([
            'user_id' => $user->id,
            'pricing_id' => Pricing::first()->id,
            'sub_total_amount' => 10000,
            'total_tax_amount' => 1000,
            'grand_total_amount' => 10000,
            'is_paid' => true,
            'payment_type' => 'midtrans',
            'started_at' => now()->addDays(-7),
            'ended_at' => now()->addDays(-1)
        ]);
    }
}
