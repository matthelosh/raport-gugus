<?php

namespace App\Http\Controllers;

use App\Ortu;
use App\Siswa;
use Illuminate\Http\Request;
// use Maatwebsite\Excel\Facades\Excel;
// use App\Imports\ImportOrtu;
// use App\Exports\ExportSiswa;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class OrtuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // Import from Excel
    public function import( Request $request)
    {
        $file = $request->file('fileOrtu');
        // $fileSize = $file->getSize();
        // echo $file->getSize();

        // $file->move('file_ortu', $file->getClientOriginalName());
        $ortus = (new FastExcel)->import($file, function($row) {
            return Ortu::create([
                'nama_ayah'     => $row['nama_ayah'],
                'nama_ibu'      => $row['nama_ibu'],
                'job_ayah'      => $row['job_ayah'],
                'job_ibu'       => $row['job_ibu'],
                'alamat_jl'     => $row['alamat_jl'],
                'alamat_desa'   => $row['alamat_desa'],
                'alamat_kec'    => $row['alamat_kec'],
                'alamat_kab'    => $row['alamat_kab'],
                'alamat_prov'   => $row['alamat_prov'],
                'hp_ortu'       => $row['hp_ortu'],
                'nama_wali'     => $row['nama_wali'],
                'job_wali'      => $row['job_wali'],
                'alamat_wali'   => $row['alamat_wali'],
                'hp_wali'       => $row['hp_wali']
            ]);
        });

        if ($ortus) {
            return redirect('/dashboard/siswas')->with(['sukses' => 'Data Ortu sudah disimpan.']);
        } else {
            return redirect('/dashboard/siswas')->with(['gagal' => 'Maaf ada yang salah. Mohon dicek kolom pada file excel']);
        }

        // return redirect('/dashboard/siswas')->withError($file->getClientOriginalName);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        try {
           $simpan =  Ortu::create([
                'nama_ayah' => $request->input('nama_ayah'),
                'nama_ibu' => $request->input('nama_ibu'),
                'job_ayah' => $request->input('job_ayah'),
                'job_ibu' => $request->input('job_ibu'),
                'job_ibu' => $request->input('job_ibu'),
                'alamat_jl'     => $request->input('alamat_jl'),
                'alamat_desa'   => $request->input('alamat_desa'),
                'alamat_kec'    => $request->input('alamat_kec'),
                'alamat_kab'    => $request->input('alamat_kab'),
                'alamat_prov'   => $request->input('alamat_prov'),
                'hp_ortu'       => $request->input('hp_ortu'),
                'nama_wali'     => $request->input('nama_wali'),
                'job_wali'      => $request->input('job_wali'),
                'alamat_wali'   => $request->input('alamat_wali'),
                'hp_wali'       => $request->input('hp_wali')
            ]);
            if ($simpan) {
               $ortu = Ortu::where('nama_ayah', $request->input('nama_ayah'))->first();
               App\Siswa::where('nisn', $request->input('nisn'))->update(['id_ortu' => $ortu->id]);
                
            } 
            // else {
            //     return json_encode(['status' => 'gagal', 'msg' => 'Data Ortu gagal disimpan']);
            // }
        }
        catch(\Exception $e) {
            return json_encode(['status' => 'gagal', 'msg' => $e]);
        }
        finally {
            $ortu = Ortu::where('nama_ayah', $request->input('nama_ayah'))->first();
            Siswa::where('nisn', $request->input('nisn'))->update(['id_ortu' => $ortu->id]);
            return json_encode(['status' => 'sukses', 'msg' => 'Data Ortu Tersimpan :)']);
        }
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
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function show(Ortu $ortu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function edit(Ortu $ortu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function updateOne(Request $request, Ortu $ortu)
    {
        //
        try {
            Ortu::where('id', $request->input('id_ortu'))->update([
                'nama_ayah' => $request->input('nama_ayah'),
                    'nama_ibu' => $request->input('nama_ibu'),
                    'job_ayah' => $request->input('job_ayah'),
                    'job_ibu' => $request->input('job_ibu'),
                    'job_ibu' => $request->input('job_ibu'),
                    'alamat_jl'     => $request->input('alamat_jl'),
                    'alamat_desa'   => $request->input('alamat_desa'),
                    'alamat_kec'    => $request->input('alamat_kec'),
                    'alamat_kab'    => $request->input('alamat_kab'),
                    'alamat_prov'   => $request->input('alamat_prov'),
                    'hp_ortu'       => $request->input('hp_ortu'),
                    'nama_wali'     => $request->input('nama_wali'),
                    'job_wali'      => $request->input('job_wali'),
                    'alamat_wali'   => $request->input('alamat_wali'),
                    'hp_wali'       => $request->input('hp_wali')
            ]);
        }
        catch(\Exception $e)
        {

        }
        finally
        {
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ortu  $ortu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ortu $ortu)
    {
        //
    }
}
