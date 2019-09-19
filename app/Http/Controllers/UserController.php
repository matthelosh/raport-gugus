<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = DB::table('users')->get();
        return view('dashboard.dashadmin', ['page' => 'users']);
    }
    public function getGurus(Request $request)
    {
        // if ($request->has('q')) {
            // $cari = $request->q;
            $guru = DB::table('users')->select('nip', 'fullname as nama_guru')->where('level' ,'=', 'guru')->get();
            return response()->json($guru);
        // }
    }
    /**
     * Get All Users With DataTables
     */

    function allUsers()
    {
        return DataTables::of(User::where('level', '<>', 'admin'))->addIndexColumn()->make(true);
    }

    /**
     * Import Users from Excel.
     * 
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        //
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        // // // Ambil file excel
        $file = $request->file('file');

        // echo $file->getSize();
        // // // Membuat nama unik
        $fileSize = $file->getSize();
        $nama_file = $fileSize.rand().$file->getClientOriginalName();
        // echo $nama_file;

        // // // Pindah ke folder publik
        // $file->move('file_users', $nama_file);
        

        // // // Import data
        Excel::import(new ImportUser, $file);

        // // // NOtifikasi flash
        Session::flash('sukses', 'Data Pengguna telah tersimpan');

        // // // Redirect
        return redirect('/dashboard/users')->with(['file' => $fileSize, 'sukses'=> 'Data Telah tersimpan.']);
        // $gurus = Guru::all();
        // return view('home', ['title' => 'Manajemen Guru', 'p' => 'adm-guru', 'datas' => $gurus ,'nama_file' =>$nama_file]);
    }

    /**
     * Export to Excel
     */

    public function export()
    {
        return Excel::download(new ExportUsers, 'DataPengguna.xlsx');
    }

    public function deleteOne(Request $request)
    {
        $id = $request->query('id');
        $delOne = User::destroy($id);

        if ($delOne) {
            return json_encode(['status' => 'sukses', 'msg' => 'Data Pengguna dihapus.', 'data' => $delOne]);
        } else {
            return json_encode(['status' => 'gagal', 'msg' => 'Gagal Mengahapus Data Pengguna', 'data' => $delOne]);
        }
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function updateOne(Request $request, User $user)
    {
        //
        try 
        {
            if ($request->input('reset_password') == false) {
                $user::where('id', $request->input('id_user'))
                        ->update([
                            'nip' => $request->input('nip'),
                            'username' => $request->input('username'),
                            'fullname' => $request->input('fullname'),
                            'email' => $request->input('email'),
                            'hp' => $request->input('hp'),
                            'level' => $request->input('level'),
                            'isActive' => $request->input('isActive')
                        ]);
            } else {
                 $user::where('id', $request->input('id_user'))
                        ->update([
                            'nip' => $request->input('nip'),
                            'username' => $request->input('username'),
                            'fullname' => $request->input('fullname'),
                            'password' => Hash::make('12345'),
                            'email' => $request->input('email'),
                            'hp' => $request->input('hp'),
                            'level' => $request->input('level'),
                            'isActive' => $request->input('isActive')
                        ]);
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return json_encode(['status' => 'gagal', 'msg' => $e]);
        } finally {
            return json_encode(['status' => 'sukses', 'msg' => 'Data '.$request->input('fullname').' telah diperbarui.']);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
