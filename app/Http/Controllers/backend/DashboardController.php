<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //DashBoard Page View
    public function index()
    {
        return view('backend.dashboard');
    }
}
