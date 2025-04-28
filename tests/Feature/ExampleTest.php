<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Ramsey\Uuid\Uuid;
use App\Models\CourseSection;
use Illuminate\Support\Facades\Log;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $booking_trx_id = (string) Uuid::uuid4();

        self::assertTrue(true);

        Log::info($booking_trx_id);
    }
}
