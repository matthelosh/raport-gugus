<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class RaportController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'forGuru']);
    }

    public function index(Request $request)
    {
        $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        session(['rombel' => $rombel]);
        return view('dashboard.dashguru', ['page' => 'raport']);
    }
    public function getSiswaku(Request $request)
    {
        $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        $siswaku = \App\Siswa::where('id_rombel', $rombel->kode_rombel)->get();
        if($request->query('tipe')) {
            return response()->json($siswaku);
        } else {
            return DataTables::of(\App\Siswa::where('id_rombel', $rombel->kode_rombel)->get())->addIndexColumn()->make(true);
        }
    }

    // public function siswaRaport(Request $request)
    // {
    //     $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
    //     $siswaku = \App\Siswa::where('id_rombel', $rombel->kode_rombel)->get();

    //     return response()->json($siswaku);
    // }

    public function mapelKu(Request $request, $rombel)
    {
        // $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        $mapels = DB::table('mapel_rombel')
                ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                ->leftJoin('rombels', 'mapel_rombel.rombel_id', '=', 'rombels.id')
                ->where('rombels.kode_rombel', $rombel)
                ->get();

        return response()->json($mapels);
    }
}
