<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function mySubscription()
    {
        return view('subscriptions.my-subscription');
    }

    public function subscriptionDetail()
    {
        return view('subscriptions.subscription-details');
    }
}
