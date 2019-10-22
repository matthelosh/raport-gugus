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
                        ['nilais.guru_id', '=', $guru_id]
                        
                        ])
                    ->leftJoin('siswas', 'siswas.nisn', '=', 'nilais.siswa_id')
                    ->select('nilais.*', 'siswas.nisn', 'siswas.nis', 'siswas.nama_siswa')
                    ->get();
        
        
        $npabps = [];
        foreach($nilais as $nilai)
        {
            if($nilai->mapel_id == 'pabp') {
                array_push($npabps, $nilai);
            }
        }
        

        dd($npabps);
        echo '<table border="1" style="border-collapse:collapse">
                <thead>
                    <tr>
                        <th>No</th><th>NISN</th><th>Nama Siswa</th><th>PKN</th>
                    </tr>
                </thead>';
            $no=0;
            foreach($nilais as $nilai)
            {
                $no++;
                echo '<tr>';
                echo '<td>'.$no.'</td><td>'.$nilai->siswa_id.'</td><td>'.$nilai->nama_siswa.'</td>';
                echo '</tr>';
            }
        echo "</table>";
        // return view('dashboard.dashguru', ['page' => 'ledger', 'text' => 'Halo, ini halaman ledger']);
    }
}
