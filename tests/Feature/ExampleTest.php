<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\CourseSection;
use Illuminate\Support\Facades\Log;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $value = CourseSection::with('course')->get()
            ->mapWithKeys(function ($courseSection) {
                return [$courseSection->id => $courseSection->name . ' - ' . $courseSection->course->name];
            });

        self::assertNotNull($value);

        Log::info($value);
    }
}
