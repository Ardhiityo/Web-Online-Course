<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::post('/checkout/callback', [TransactionController::class, 'checkoutCallback'])
    ->name('checkout.callback');
