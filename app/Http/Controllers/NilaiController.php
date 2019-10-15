<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
