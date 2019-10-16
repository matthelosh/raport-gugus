<?php

namespace App\Http\Controllers;

use App\Kd;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
class KdController extends Controller
{

    public function getByKelas(Request $request)
    {
        return DataTables::of(Kd::where([['tingkat','=',$request->query('kelas')],['id_mapel','=',$request->query('mapel')]])->get())->addIndexColumn()->make(true);
    }

    // Sel2Kd
    public function sel2_kd(Request $request, $kelas, $mapel)   
    {
        $kds = Kd::select("kds.*", DB::raw("CONCAT(kds.kode_kd, ' ', kds.teks_kd) AS teks"))
                    ->where('tingkat', $kelas)
                    ->where('id_mapel', $mapel)
                    ->where('ki_id', '!=', '1')
                    ->where('ki_id', '!=', '2')
                    ->get();
        return response()->json($kds);
        // return response()->json(['kode_kd' =>$kelas,'teks_kd' =>$mapel]);
    }

    public function selByTema(Request $request, $mapel, $subtema)
    {
       $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        if (!$request->query('mapel') || $request->query('mapel') === 'null') {
            $cek = \App\Tematik::where([['mapel_id','=',$mapel], ['subtema_id', '=', $subtema]])
                                ->leftJoin('kds', 'tematiks.kd_id', '=', 'kds.kode_kd')
                                ->where([['kds.tingkat','=',$rombel->tingkat],['kds.id_mapel', '=', $mapel]])
                                ->select("kds.*", DB::raw("CONCAT(kds.kode_kd, ' ', kds.teks_kd) AS teks"))
                                ->get();
            return response()->json($cek);
        } else {
            $mapels = \App\Mapel::where('nama_mapel', $request->query('mapel'))->first();
            // print_r(json_encode($mapels));
            $kds = \App\Kd::where('id_mapel', $mapels->kode_mapel)
                            ->where('tingkat', $rombel->tingkat)
                            ->select("kds.*", DB::raw("CONCAT(kds.kode_kd, ' ', kds.teks_kd) AS teks"))
                            ->get();
            return response()->json($kds);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function show(Kd $kd)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function edit(Kd $kd)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kd $kd)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kd  $kd
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kd $kd)
    {
        //
    }
}
