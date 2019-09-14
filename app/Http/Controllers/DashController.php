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
        switch($user->level) {
            case 'guru':
                return view('dashboard.dashguru');
                break;
            case 'admin':
                return view('dashboard.dashadmin');
                break;
            case 'kepsek':
                return view('dashboard.dashkepsek');
                break;
        }
    }
}
