<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view("dashboard");
    }
}
