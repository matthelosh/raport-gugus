<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Nilai;
use Illuminate\Support\Facades\Hash;

class NilaiController extends Controller
{
    //
    public function __construct()   
    {
        $this->middleware('auth');
    }

    public function indexHarian(Request $request)
    {
        $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        $temas = \App\Tema::where('id_tingkat', $rombel->tingkat)->with('subtemas')->get();
        $tematis = \App\Tematik::where('tingkat_id', $rombel->tingkat)->with('subtemas')->get();
        $mapels = DB::table('mapel_rombel')
                    ->leftJoin('rombels', 'mapel_rombel.rombel_id', '=', 'rombels.id')
                    ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                    ->where('rombels.tingkat', $rombel->tingkat)
                    ->get();
        // $tematis = \App\Tematik::
        $mt = [];
        foreach($tematis as $tema) 
        {
                array_push($mt, $tema->mapels->nama_mapel);
                // array_push($mt, "\"".$tema->mapels->nama_mapel."\"");
                // $mt[$tema->mapels->kode_mapel] = $tema->mapels->nama_mapel;
        }
        sort($mt);

        // print_r($mt);
        // echo '<hr>';

        $mapelst = $this->remDup($mt);
        // print_r($mt);
        $maptema = array();
        foreach($mapelst as $mapel)
        {
            // $maptema[$mapel['kode_mapel']] = $mapel['nama_mapel'];
            array_push($maptema, $mapel);
            // print_r($mapel);
        }

        // print_r($maptema);
        // echo '<hr>';

        $mapelsnt = [];
        foreach($mapels as $mapel)
        {
           array_push($mapelsnt, $mapel->nama_mapel);
        //    print_r($mapel->nama_mapel);

        }

    //    print_r($mapelsnt);
    //     echo '<hr>';

        

        $a = array('a', 'b', 'c', 'd');
        $b = array('a', 'c', 'e');
        $res = array_diff($mapelsnt, $mapelst );
        // print_r($res);
        
        // print_r(json_encode($mapels));


        




        return view('dashboard.dashguru',['page'=>'nharian', 'temas'=>$temas, 'rombel' => $rombel, 'nontemas' => $res]);
    }

    // /ajax/nilai/tapel/2019_2020/semester/ganjil/aspek/0/tipe/0/kd/null
    public function entriNilai(Request $request)
    {
        $data = $request->input('nisn');
        // $nisns = $request->input('nilai');
        $guru_id = $request->user()->nip;
        $rombel = \App\Rombel::where('id_guru', $guru_id)->first();
        
        $mapel = \App\Mapel::where('nama_mapel', $request->query('nama_mapel'))->first();
        // echo $guru_id.' '.$rombel->kode_rombel.'<br>';
        // print_r($request->query());
        try {
            foreach($data as $nisn)
            {
                $nilai = $request->input('n-'.$nisn);
                // $mapel = ($request->query('mapel') != 'null') ? $request->query('mapel') : $mapel->kode_mapel;
                $kode_nilai = $nisn.$request->query('tapel').$request->query('periode').$mapel->kode_mapel.$request->query('subtema').$request->query('kd').$request->query('aspek').$request->query('tipe').$guru_id;
                Nilai::create([
                    'kode_nilai' => $kode_nilai,
                    'tapel' => $request->query('tapel'),
                    'semester' => $request->query('semester'),
                    'periode' => $request->query('periode'),
                    'rombel_id' => $rombel->kode_rombel,
                    'mapel_id' => ($request->query('mapel') != 'null') ? $request->query('mapel') : $mapel->kode_mapel,
                    'subtema_id' => ($request->query('subtema')!='null') ? $request->query('subtema') : 'null',
                    'kd_id' => ($request->query('kd') != 'null') ? $request->query('kd') : 'null',
                    'aspek_id' => $request->query('aspek'),
                    'tipe_nilai_id' => $request->query('tipe'),
                    'guru_id' => $guru_id,
                    'siswa_id' => $nisn,
                    'nilai' => $nilai
                ]);

                // print_r($kode_nilai.'<br>');
            }
            
            return response()->json(['status' => 'sukses', 'msg' => 'Data Nilai Kelas: '.$rombel->nama_rombel.' telah tersimpan.']);
        }
        catch (\Exception $e)
        {
            return response()->json(['status' => 'gagal', 'msg' =>$e->getMessage()]);
            // print_r($e->getMessage());
        }
        
        // dd($data['n/ila/si']);
        // print_r($nisns['0071968185']);
    }

    public function remDup($arr)
    {
        $j=0;
        $res = [];
        for($i=0;$i<count($arr)-1;$i++)
        {
            if($arr[$i] != $arr[$i+1])
            {
                // $mapelst[$j] = $mt[$i];
                array_push($res, $arr[$i]);
                $j++;
            }
        }

        return $res;
    }

    public function indexPts(Request $request)
    {
        $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
        $mapels = DB::table('mapel_rombel')
                    ->leftJoin('rombels', 'mapel_rombel.rombel_id', '=', 'rombels.id')
                    ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                    ->where('rombels.tingkat', $rombel->tingkat)
                    ->get();

        return view('dashboard.dashguru', ['page'=>'npts', 'mapels' => $mapels, 'rombel'=>$rombel]);
    }
}
