<?php

namespace App\Http\Controllers;

use App\Mapel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Imports\ImportMapel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.dashadmin', ['page' => 'mapel']);
    }

    public function import(Request $request)
    {
        $file = $request->file('fileMapel');
        try {
            $namaFile = $file->getClientOriginalName();
            $file->move(public_path('files'), $namaFile);
            Excel::import(new ImportMapel, 'files/'.$namaFile);

            return redirect('/dashboard/settings/mapel')->withMessage('Data Mapel Berhasil diimpor');
        }
        catch(\Exception $e) {
            return back()->withError('Gagal: '. $e->getMessage());
        }
    }

    // Mapel By Tema
    public function mapelByTema(Request $request, $tema)
    {
        $mapels = \App\Tematik::where('tema_id', $tema)
                                ->with('mapels')
                                ->get();
        // $mapels = DB::table('tematiks')
        //           ->where('tema_id', $tema)
        //           ->where('kds.id_mapel', 'mapels.kode_mapel')
        //           ->leftJoin('mapels', function($join) {
        //               $join->on('tematiks.mapel_id','=', 'mapels.kode_mapel');
        //           })
        //           ->leftJoin('kds', function($join) {
        //               $join->on('tematiks.kd_id', '=', 'kds.kode_kd');
                      
        //           })
        //           ->get();
        
        return response()->json($mapels);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function showByRombel(\App\Rombel $rombel = null)
    {
            return DataTables::of($rombel->mapels)->addIndexColumn()->make(true);
    }

    public function showByTingkat(Request $request, $kelas)
    {
        $mapels = DB::table('mapel_rombel')
                    ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                    ->leftJoin('rombels', 'mapel_rombel.rombel_id', '=', 'rombels.id')
                    ->where('rombels.tingkat',$kelas)
                    ->where('nama_mapel', 'like', '%'.$request->query('q').'%')
                    ->get();
        return response()->json($mapels);
    }

    public function show(Request $request)
    {
        return DataTables::of(Mapel::all())->addIndexColumn()->make(true);
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function edit(Mapel $mapel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mapel $mapel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mapel $mapel)
    {
        //
    }
}
