<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nilai;
use Illuminate\Support\Facades\DB;

class LedgerController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth', 'forGuru']);
    }

    public function index(Request $request)
    {
        $guru_id = $request->user()->nip;
        $rombel = \App\Rombel::where('id_guru', $guru_id)->first();
        $nilais = DB::table('nilais')
                    ->where([
                        ['nilais.rombel_id', '=', $rombel->kode_rombel],
                        ['nilais.guru_id', '=', $guru_id],
                        ['nilais.kd_id', 'like', '3.%']
                        ])
                    ->leftJoin('siswas', 'siswas.nisn', '=', 'nilais.siswa_id')
                    ->select('nilais.*', 'siswas.nisn', 'siswas.nis', 'siswas.nama_siswa')
                    ->get();
        $mapels = DB::table('mapel_rombel')
                    ->where('mapel_rombel.rombel_id',$rombel->id)
                    ->leftJoin('mapels', 'mapel_rombel.mapel_id', '=', 'mapels.id')
                    ->get();
        
        $kds = DB::table('kds')
                    ->where([['tingkat', $rombel->tingkat],['kode_kd', 'like', '3.%']])
                    ->get();

        // var_dump($kds);
        $kds_by_mapel = [];
        foreach($kds as $kd)
        {
            $kds_by_mapel[$kd->id_mapel][] = $kd;
        }
        $nil_by_siswa = [];
        // dd($nilais);
        $nilai_bymapel = [];
        $siswas = [];
        foreach($nilais as $nilai)
        {
            
            $nilai_bymapel[$nilai->mapel_id][] = $nilai;
            $nil_by_siswa[$nilai->siswa_id][] = $nilai;
            array_push($siswas, ['nisn' => $nilai->siswa_id, 'nama_siswa' => $nilai->nama_siswa]);
            
        }

        dd($nil_by_siswa);
        $resnilai = [];
        // $nilai = [
        //     'pabp' => [
                    // '3.1' => [
                        // 'nis' => '123', 'rombel_id' => 'vi', 'nilai' => 90
                    // ],
                    // '3.2' => [
                        // 'nis' => '123', 'rombel_id' => 'vi', 'nilai' => 90
                    // ]
            // ],
            //  'bid' => [
                // '3.1' => [
                        // 'nis' => '123', 'rombel_id' => 'vi', 'nilai' => 90
                    // ],
                    // '3.2' => [
                        // 'nis' => '123', 'rombel_id' => 'vi', 'nilai' => 90
                    // ]
            // ],
            // ...
        // ]
        $resSiswa = $this->rem_dup_obj($siswas);
        $j=0;
        foreach($nilai_bymapel as $nkd)
        {
            $j++;
            for($i=0;$i<count($nkd);$i++)
            {
                $resnilai[$nkd[$i]->mapel_id][$nkd[$i]->kd_id][] = $nkd;
            }
        } 

        
        echo '<div style="position:relative;width: 98vw; height: 90vh;overflow:scroll;">';
        echo '<table border="1" style="border-collapse:collapse; ">
                <thead>
                    <tr>
                        <span class="fixed"><th rowspan="2">No</th><th rowspan="2">NISN</th><th rowspan="2">Nama Siswa</th></span>';
                        foreach($mapels as $mapel)
                        {
                            echo '<th colspan='.count($kds_by_mapel[$mapel->kode_mapel]).'>'.$mapel->nama_mapel.'</th>';
                        }
                    
                echo '</tr><tr>';
                    foreach($mapels as $mapel) {
                        foreach($kds_by_mapel[$mapel->kode_mapel] as $kd){
                            echo '<th>'.$kd->kode_kd.'</th>';
                        }
                    }
                echo '</tr>
                </thead>';
            $no=0;
            foreach($nil_by_siswa as $siswa)
            {
                $no++;
                echo '<tr>';
                echo '<span class="fixed"><td>'.$no.'</td><td>'.$siswa[0]->siswa_id.'</td><td>'.$siswa[0]->nama_siswa.'</td></span>';
                foreach($mapels as $mapel) {
                    foreach($kds_by_mapel[$mapel->kode_mapel] as $kd){
                        // echo '<td></td>';
                        foreach($siswa as $n) {
                            if($n->kd_id == $kd->kode_kd && $n->mapel_id == $mapel->kode_mapel)
                            {
                                echo '<td>'.$n->nilai.' '.$n->mapel_id.' '.$n->kd_id.'</td>';
                            } 
                            else 
                            {
                               echo '<td></td>';
                            }
                       }
                   }
                }
                
                echo '</tr>';
            }
        echo "</table></div>";
        // return view('dashboard.dashguru', ['page' => 'ledger', 'text' => 'Halo, ini halaman ledger']);
    }


    

    public function rem_dup_obj($array, $keep_key_assoc = false)
    {
        $duplicate_keys = array();
        $tmp         = array();       
    
        foreach ($array as $key=>$val)
        {
            // convert objects to arrays, in_array() does not support objects
            if (is_object($val))
                $val = (array)$val;
    
            if (!in_array($val, $tmp))
                $tmp[] = $val;
            else
                $duplicate_keys[] = $key;
        }
    
        foreach ($duplicate_keys as $key)
            unset($array[$key]);
    
        return $keep_key_assoc ? $array : array_values($array);
    }
    public function remDupArray($arr)
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
