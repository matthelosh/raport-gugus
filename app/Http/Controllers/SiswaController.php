<?php

namespace App\Http\Controllers;

use App\Siswa;
use App\Ortu;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportSiswa;
use App\Exports\ExportSiswa;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.dashadmin', ['page' => 'siswas']);
    }

    function allSiswas()
    {
        return DataTables::of(DB::table('siswas')
                                        ->leftJoin('ortus', 'siswas.id_ortu', '=', 'ortus.id')
                                        ->select('siswas.*', 'ortus.id as idOrtu', 'ortus.nama_ayah', 'ortus.nama_ibu', 'ortus.job_ayah', 'ortus.job_ibu', 'ortus.hp_ortu', 'ortus.alamat_jl', 'ortus.alamat_desa', 'ortus.alamat_kec', 'ortus.alamat_kab', 'ortus.alamat_prov', 'ortus.nama_wali', 'ortus.job_wali', 'ortus.alamat_wali', 'ortus.hp_wali')
                                        ->get()
                            )->addIndexColumn()->make(true);
        // return DataTables::of(Siswa::with(['ortus'])->get())->make(true);
    }

    public function import(Request $request)
    {
        //
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);

        // // // // Ambil file excel
        $file = $request->file('file');
        // echo $file->getSize();

        // // // // Membuat nama unik
        // $fileSize = $file->getSize();
        // $nama_file = $fileSize.rand().$file->getClientOriginalName();
        // // echo $nama_file;

        // // // // Pindah ke folder publik
        // // $file->move('file_users', $nama_file);
        

        // // // // Import data
        $import = Excel::import(new ImportSiswa, $file);

        // // // // NOtifikasi flash
        // // Session::flash('sukses', 'Data Siswa telah tersimpan');
        // echo $import;
        // // // // Redirect
        return redirect('/dashboard/siswas')->with(['file' => $file->getClientOriginalName(), 'sukses'=> 'Data Telah tersimpan.']);
        // $gurus = Guru::all();
        // return view('home', ['title' => 'Manajemen Guru', 'p' => 'adm-guru', 'datas' => $gurus ,'nama_file' =>$nama_file]);
    }

    /**
     * Export to Excel
     */

    public function exportAll()
    {
        return Excel::download(new ExportSiswa, 'DataSemuaSiswa.xlsx');
    }

    public function deleteOne(Request $request)
    {
        try {
            $nisn = $request->query('nisn');
            $delOne = Siswa::where('nisn', $nisn)->delete();
        }
        catch(\Exception $e)
        {
            return json_encode(['status' => 'gagal', 'msg' => 'Gagal Mengahapus Data Pengguna', 'data' => $e]);
        // }
        }   
        finally
        {
            return json_encode(['status' => 'sukses', 'msg' => 'Data Siswa dihapus.', 'data' => $delOne]);
        } 
        // if ($delOne) {
        //     return json_encode(['status' => 'sukses', 'msg' => 'Data Pengguna dihapus.', 'data' => $delOne]);
        // } else {
        //     return json_encode(['status' => 'gagal', 'msg' => 'Gagal Mengahapus Data Pengguna', 'data' => $delOne]);
        // }
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
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //
    }
}
