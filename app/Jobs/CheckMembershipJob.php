<?php

namespace App\Jobs;

use App\Models\Transaction;
use Illuminate\Bus\Batchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CheckMembershipJob implements ShouldQueue
{
    use Queueable, Batchable, SerializesModels, Dispatchable, InteractsWithQueue;

    public $tries = 3;
    public $timeout = 120;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Transaction::where('is_paid', true)
            ->where('ended_at', '<', now())
            ->chunk(100, function ($transactions) {
                foreach ($transactions as $transaction) {
                    $transaction->update([
                        'is_paid' => false,
                    ]);
                }
            });
    }
}
