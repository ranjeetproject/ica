<?php

namespace App\Http\Controllers\WebFrontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function homePageDisplay()
    {
        return view('WebFrontend.home');
    }
}
