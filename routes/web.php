<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'role:student'])->group(function () {
    Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

    Route::prefix('checkout')->name('checkout.')->group(function () {
        Route::controller(SubscriptionController::class)->group(function () {
            Route::get('/my-subscriptions', 'mySubscription')->name('my-subscription');
            Route::get('/subscription-details/{transaction}',  'subscriptionDetail')->name('subscription-details');
        });

        Route::controller(TransactionController::class)->group(function () {
            Route::post('/',  'checkoutStore')->name('store');
            Route::get('/success',  'success')->name('success');
            Route::get('/{pricing}',  'checkout')->name('details');
        });
    });

    Route::middleware('membership')->group(function () {
        Route::prefix('course')->name('course.')
            ->controller(CourseController::class)
            ->group(function () {
                Route::get('/',  'catalog')->name('index');
                Route::get('/search',  'search')->name('search');
                Route::get('/details/{course:slug}',  'courseDetails')->name('details');
                Route::get('/success-join/{course:slug}',  'successJoin')->name('success-join');
                Route::get('/learning/{course:slug}/{courseSection}/{sectionContent}',  'learning')->name('learning');
                Route::get('/learning/{course:slug}/finished',  'learningFinished')->name('learning-finished');
            });
    });
});

require __DIR__ . '/auth.php';
