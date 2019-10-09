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
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\DataTables\DataTables;
use Illuminate\Http\UploadedFile;

class SiswaController extends Controller
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
    public function index(Request $request)
    {
        //
        $level = $request->user()->level;
        switch($level) {
            case 'admin':
                return view('dashboard.dashadmin', ['page' => 'siswas']);
                break;
            case 'guru':
                return view('dashboard.dashguru', ['page' => 'siswaku']);
                break;
        }
        
    }

    function allSiswas(Request $request)
    {
        if ($request->user()->level == 'admin') {
                return DataTables::of(
                DB::table('siswas')
                                            ->leftJoin('ortus', 'siswas.id_ortu', '=', 'ortus.id')
                                            ->select('siswas.*', 'ortus.id as idOrtu', 'ortus.nama_ayah', 'ortus.nama_ibu', 'ortus.job_ayah', 'ortus.job_ibu', 'ortus.hp_ortu', 'ortus.alamat_jl', 'ortus.alamat_desa', 'ortus.alamat_kec', 'ortus.alamat_kab', 'ortus.alamat_prov', 'ortus.nama_wali', 'ortus.job_wali', 'ortus.alamat_wali', 'ortus.hp_wali')
                                            ->get()
            )->addIndexColumn()->make(true);
        } else if($request->user()->level == 'guru') {
            try {
                $rombel = \App\Rombel::where('id_guru', $request->user()->nip)->first();
                return DataTables::of(
                    DB::table('siswas')
                                                ->leftJoin('ortus', 'siswas.id_ortu', '=', 'ortus.id')
                                                ->select('siswas.*', 'ortus.id as idOrtu', 'ortus.nama_ayah', 'ortus.nama_ibu', 'ortus.job_ayah', 'ortus.job_ibu', 'ortus.hp_ortu', 'ortus.alamat_jl', 'ortus.alamat_desa', 'ortus.alamat_kec', 'ortus.alamat_kab', 'ortus.alamat_prov', 'ortus.nama_wali', 'ortus.job_wali', 'ortus.alamat_wali', 'ortus.hp_wali')
                                                ->where('id_rombel', $rombel->kode_rombel)
                                                ->get()
                    )->addIndexColumn()->make(true);

            }
            catch(\Exception $e) {
                return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
            }
        }
        // return DataTables::of(Siswa::with(['ortus'])->get())->make(true);
    }

    public function import(Request $request)
    {
        //
        // $this->validate($request, [
        //     'file' => 'required|mimes:csv,xls,xlsx'
        // ]);
        try {

        // // // // Ambil file excel
            $file = $request->file('file');
            // echo $file->getSize();

            // // // // Membuat nama unik
            $nama = $file->getClientOriginalName();
            // $nip = Auth::user()->nip;
            $newName = $file->getClientOriginalName().'.'.$file->getClientOriginalExtension();
            $size = $file->getClientSize();

            // // // // Pindah ke folder publik
            // $file->move(public_path('files/'), $newName );
        

            // // // // Import data
            $import = Excel::import(new ImportSiswa, $file);

            // // // // NOtifikasi flash
            // // Session::flash('sukses', 'Data Siswa telah tersimpan');
            // echo $import;
            // // // // Redirect
            echo $import;
            // if ($request->user()->level == 'admin') {
            //     // return redirect('/dashboard/siswas')->with(['file' => $file->getClientOriginalName(), 'sukses'=> 'Data Telah tersimpan.']);
            // } else {
            //     return redirect('/dashboard/siswaku')->with(['file' => $file->getClientOriginalName(), 'sukses'=> 'Data Telah tersimpan.']);
            // }
        }
        catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
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
    // Pindah Rombel
    public function pindahRombel(Request $request)
    {
        $tujuan = $request->input('tujuan');
        $nisns = $request->input('nisns');

        try {
            foreach ($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['id_rombel' => $tujuan]);
            }
        
            return response()->json(['status' => 'sukses', 'msg' => 'Siswa-siswa tersebut telah dipindah ke rombel tujuan']);
        }
        catch(\Exception $e) {
            return resposn()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    // Keluarkan dari Rombel
    public function keluarkan(Request $request)
    {
        $nisns = $request->input('nisns');
        try {
            foreach($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['id_rombel' => '0']);
            }

            return response()->json(['status' => 'sukses', 'msg' => 'Berhasil mengeluarkan siswa']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }

    }

    // Masukkan siswa ke rombel
    public function masukkan(Request $request)
    {
        $tujuan = $request->input('tujuan');
        $nisns = $request->input('nisns');

        try {
            foreach($nisns as $nisn) {
                Siswa::where('nisn', $nisn)->update(['id_rombel' => $tujuan]);
            }

            return response()->json(['status' => 'sukses', 'msg' => 'Berhasil Memasukkan siswa']);
        } catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getCode()]);
        }
    }

    // Get Non Members
    public function getNonMembers(Request $request)
    {
        return DataTables::of(Siswa::where('id_rombel', '0')->get())->addIndexColumn()->make(true);
    }
    // Get Members
    public function getMembers(Request $request)
    {
        $kode_rombel = $request->query('kode');

        // $members = Siswa::where('id_rombel', $kode_rombel)->get();

        return DataTables::of(DB::table('siswas')->where('id_rombel', $kode_rombel)->get())->addIndexColumn()->make(true);
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
        try {
            Siswa::where('id', $request->input('id_siswa'))->update([
                'nis'          => $request->input('nis'),
                'nisn'         => $request->input('nisn'),
                'nama_siswa'   => $request->input('nama_siswa'),
                'jk'           => $request->input('jk'),
                'agama'        => $request->input('agama'),
                'alamat'       => $request->input('alamat'),
                'asal_sekolah' => $request->input('asal_sekolah'),
                // 'id_ortu'      => $request->input('id_ortu')
            ]);
            return response()->json(['status' => 'sukses', 'msg' => 'Data '.$request->input('nama_siswa').' diperbarui']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
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
