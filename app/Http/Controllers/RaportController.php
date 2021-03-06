<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public function rankpts($nisn, $tapel, $semester, $rombel){
        $rombel = \App\Rombel::where('id_guru', Auth::user()->nip)->first();
        $nilais = DB::table('nilais')
                    ->where([
                        ['rombel_id', '=', $rombel->kode_rombel],
                        ['tapel', '=', $tapel],
                        ['semester', '=', $semester],
                        ['periode', '=','harian'],
                        ['kd_id', 'like', '3.%']

                    ])
                    // ->selectRaw('sum(nilai) as sum, *' )
                    // ->groupBy('siswa_id')
                    ->get();

        // return $nilais;
        $byNisn = [];
        foreach($nilais as $nilai)
        {
            $byNisn[$nilai->siswa_id][$nilai->mapel_id][$nilai->kd_id] = $nilai->nilai;
        }
        $nTemp =[];
        foreach($byNisn as $key=>$val)
        {
            // dd($item);
            foreach($val as $mapel=>$nilai)
            {
                $nTemp[$key][$mapel] = array_sum($nilai)/count($nilai);
            }
            // $nTemp[$key] = array_sum($val)/count($val);
        }
        // return $byNisn;
        $nf=[];
        foreach($nTemp as $k=>$v)
        {
            $nf[$k] = array_sum($v)/count($v);
        }
        arsort($nf);
        $rank = 0;
        // foreach($nf as $f=>$t)
        // {
            $rank = array_search($nisn, array_keys($nf));
        // }

        return [$rank, count($nf)];

    }

    public function rpts(Request $request, $nisn, $tapel, $semester, $rombel)
    {
        // $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        $mapels = DB::table('mapel_rombel')
                ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                ->leftJoin('rombels', 'mapel_rombel.rombel_id', '=', 'rombels.id')
                ->where('rombels.kode_rombel', $rombel)
                ->get();
        
        $nhres = DB::table('nilais')
                  ->where([
                        ['siswa_id', '=', $nisn],
                        ['tapel', '=', $tapel],
                        ['semester', '=', $semester],
                        ['periode', 'harian'],
                        ['kd_id', 'like', '3.%']
                  ])
                  ->get();
        $nptsres = DB::table('nilais')
                  ->where([
                        ['siswa_id', '=', $nisn],
                        ['tapel', '=', $tapel],
                        ['semester', '=', $semester],
                        ['periode', 'pts'],
                        // ['kd_id', 'like', '3.%']
                  ])
                  ->get();
        $nekskuls = DB::table('ekskuls')
                    ->where([
                            ['rombel_id', '=', $rombel],
                            ['siswa_id', '=', $nisn],
                            ['tapel', '=', $tapel],
                            ['semester', '=', $semester]
                        ])
                    ->first();
        
        $mapelsTmp = [];
        $nhs = [];
        $npts = [];
        foreach($mapels as $mapel)
        {
            array_push($mapelsTmp, ['kode_mapel' => $mapel->kode_mapel, 'nama_mapel' => $mapel->nama_mapel, 'nh'=> []]);
            // array_push($nama_mapels, $mapel->nama_mapel);
        }
        $nhms = [];
        foreach($mapelsTmp as $mapel)
        {
            $nhms[$mapel['kode_mapel']]['nama_mapel'] = $mapel['nama_mapel'];
            $nhms[$mapel['kode_mapel']]['nh'] = 0;
            $nhms[$mapel['kode_mapel']]['pts'] = 0;
        }

        // Nilai Harian
        foreach($nhres as $nh){
            // array_push($nhs, ['kode_mapel' => $nh->mapel_id, 'nh' => $nh->nilai]);
            $nhs[$nh->mapel_id][] = $nh->nilai;
        }
        foreach($nhs as $key=>$val)
        {
            $nhms[$key]['nh'] = array_sum($val)/count($val);
        }
        // End NIlai Harian

        // Nilai PTS
        foreach($nptsres as $npt)
        {
            if(isset($npt->mapel_id))
            {
                $npts[$npt->mapel_id][] = $npt->nilai;
            }
            
        }
        foreach($npts as $key=>$val)
        {
            $nhms[$key]['pts'] = array_sum($val)/count($val);
        }

        $rank = $this->rankpts($nisn, $tapel, $semester, $rombel);

        return response()->json(['mapels' => $mapels, 'nrpts' => $nhms, 'rank' => $rank, 'ekskuls' => $nekskuls]);
        // dd($nhms);
    }

}
