<?php

namespace App\Http\Controllers;

use App\Tema;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\DB;
use App\Imports\ImportTema;
use Yajra\DataTables\DataTables;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('dashboard.dashadmin', ['page'=>'tema']);
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

    // Import Tema
    public function import(Request $request)
    {
        $file = $request->file('fileTema');
        $oriName = $file->getClientOriginalName();

        $newName = rand(0, 8).$oriName;

        $file->move(public_path('files'), $newName);

        try {
            $import = Excel::import(new ImportTema, 'files/'.$newName);
            // return back()->withMessage('Impor Data Tema Berhasil');
            // if($import) {
                return redirect('dashboard/settings/tematik')->with('message', 'Impor Sukses');
            // }
            // echo $import;
        }
        catch(\Exception $e) {
            // echo 'Import gagal:<br>';
            // print_r($e->getMessage());
            return back()->withError($e->getMessage());
            // echo $e->getMessage();
        }

        
    }

    public function allTemas(Request $request)
    {
        return DataTables::of(Tema::all())->addIndexColumn()->make(true);
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
     * @param  \App\Tema  $tema
     * @return \Illuminate\Http\Response
     */
    public function show(Tema $tema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tema  $tema
     * @return \Illuminate\Http\Response
     */
    public function edit(Tema $tema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tema  $tema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tema $tema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tema  $tema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tema $tema)
    {
        //
    }
}
