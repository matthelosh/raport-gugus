<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $user = $request->user();
        
        return view('dashboard.layout');
    }
}
