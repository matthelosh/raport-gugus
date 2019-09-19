<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rombel;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;



class RombelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.dashadmin', ['page' => 'rombels']);
    }
    public function allRombels()
    {
        $level = Auth::user()->level;
        if ($level == 'guru') {

        } else {
            return DataTables::of(DB::table('rombels')
                                ->join('users', 'rombels.id_guru', '=', 'users.nip')
                                ->select('rombels.*', 'users.nip as id_guru', 'users.fullname as nama_guru')
                                ->get()
                            )->addIndexColumn()->make(true);
        }
    }
}
