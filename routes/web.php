<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

Route::middleware('auth')->group(function () {
    Route::post('/checkout', [TransactionController::class, 'checkoutStore'])->name('checkout.store');
    Route::get('/checkout/my-subscriptions', [SubscriptionController::class, 'mySubscription'])->name('checkout.my-subscription');
    Route::get('/checkout/subscription-details/{transaction}', [SubscriptionController::class, 'subscriptionDetail'])->name('checkout.subscription-details');
    Route::get('/checkout/success/{orderId}', [TransactionController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/{pricing}', [TransactionController::class, 'checkout'])->name('checkout');

    Route::middleware('membership')->group(function () {
        Route::get('/course', [CourseController::class, 'catalog'])->name('course');
        Route::get('/course/details/{slug}', [CourseController::class, 'courseDetails'])->name('course-details');
        Route::get('/course/success-join/{slug}', [CourseController::class, 'successJoin'])->name('course-success-join');
        Route::get('/course/learning/{slug}/{courseSectionId}/{sectionContentId}', [CourseController::class, 'learning'])
            ->name('course-learning');
        Route::get('/course/learning/next/{slug}/{courseSectionId}/{sectionContentId}', [CourseController::class, 'nextLearning'])
            ->name('course-learning-next');
        Route::get('/course/learning/{slug}/finished', [CourseController::class, 'learningFinished'])
            ->name('course-learning-finished');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
