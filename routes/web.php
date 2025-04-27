<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

Route::get('/checkout/success', [TransactionController::class, 'success'])->name('checkout.success');

Route::middleware('auth')->group(function () {
    Route::post('/checkout', [TransactionController::class, 'checkoutStore'])->name('checkout.store');
    Route::get('/checkout/{pricing}', [TransactionController::class, 'checkout'])->name('checkout');
    Route::get('/my-subscriptions', [SubscriptionController::class, 'mySubscription'])->name('my-subscription');
    Route::get('/subscription-details', [SubscriptionController::class, 'subscriptionDetail'])->name('subscription-detail');
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
