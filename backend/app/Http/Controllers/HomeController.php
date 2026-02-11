<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the Enterprise Gateway (Homepage).
     */
    public function index()
    {
        return view('welcome');
    }
}
