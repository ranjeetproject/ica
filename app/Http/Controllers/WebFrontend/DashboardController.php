<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardPageDisplay()
    {
        return view('WebFrontend.dashboard');
    }
}
