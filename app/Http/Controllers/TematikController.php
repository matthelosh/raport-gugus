<?php

namespace App\Http\Controllers;
use App\Tematik;
use Illuminate\Http\Request;
use App\Mapel;
use Illuminate\Support\Facades\DB;

class TematikController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.dashadmin', ['page' => 'tematik']);
    }

    public function map(Request $request, $tingkat)
    {
        // $tematiks =Tematik::where('tematiks.tingkat_id', $tingkat)->get();
        // $tematiks = DB::select(DB::raw("SELECT tematiks.id, tematiks.kd_id, tematiks.mapel_id, tematiks.subtema_id, tematiks.tingkat_id, subtemas.kode_subtema, subtemas.teks_subtema, mapels.kode_mapel, mapels.nama_mapel, kds.id_mapel, kds.kode_kd, kds.tingkat, kds.teks_kd FROM tematiks
        // LEFT JOIN subtemas ON tematiks.subtema_id = subtemas.kode_subtema
        // LEFT JOIN mapels ON tematiks.mapel_id = mapels.kode_mapel
        // LEFT join kds ON kds.id_mapel = mapels.kode_mapel
        // WHERE tematiks.tingkat_id = 1
        // AND kds.id_mapel = tematiks.mapel_id
        // -- AND tematiks.subtema_id = 
        // -- GROUP BY tematiks.subtema_id
        // "));

        $tematiks = Tematik::where('tematiks.tingkat_id', $tingkat)
                            ->leftJoin('mapels', 'mapels.kode_mapel','=','tematiks.mapel_id')
                            ->leftJoin('kds', function($join) {
                                $join->on('kds.id_mapel', '=', 'mapels.kode_mapel')
                                    ->on('kds.kode_kd', '=', 'tematiks.kd_id')
                                    ->where('kds.kode_kd', 'tematiks.kd_id')
                                    ->select('kds.*');
                            })
                            ->select('tematiks.*', 'mapels.*')
                            
                            ->get();
                            // $headers = array_keys(json_decode($tematiks));
                            // print_r(json_decode($tematiks));
                            return $tematiks;
        
    }

}

