<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("home");
    }

    public function pricing()
    {
        return view("pricing");
    }

    public function checkout()
    {
        return view("checkout");
    }
}
