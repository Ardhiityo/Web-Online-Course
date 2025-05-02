<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Transaction;
use App\Models\CourseSection;
use Database\Seeders\TransactionSeeder;
use Illuminate\Support\Facades\Log;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // $paginate = CourseSection::pluck('id')->toArray();
        // Log::info($paginate);

        // $chunk = User::chunk(2, function ($user) {
        //     foreach ($user as $u) {
        //         self::assertNotNull($user);
        //         Log::info($u);
        //     }
        // });

        // $this->seed(TransactionSeeder::class);

        Transaction::where('is_paid', true)
            ->where('ended_at', '<', now())
            ->chunk(100, function ($transactions) {
                foreach ($transactions as $transaction) {
                    self::assertNotNull($transaction);
                    Log::info($transaction);
                    $transaction->update([
                        'is_paid' => false,
                    ]);
                }
            });
    }
}
