<?php

namespace App\Http\Controllers;

use App\Subtema;
use Illuminate\Http\Request;
use App\Imports\ImportSubtema;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class SubtemaController extends Controller
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

    public function import(Request $request)
    {
        $file = $request->file('fileSubtema');
        try{
            $pindah = $file->move(public_path('files'), $file->getClientOriginalName());
            Excel::import(new ImportSubtema, 'files/'.$file->getClientOriginalName());
            return redirect('/dashboard/settings/tematik')->withMessage('Subtema telah diimpor');
        }
        catch(\Exception $e) {
            return back()->withError('Gagal '.$e->getMessage());
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
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $id_tema = $request->query('id_tema');
        return DataTables::of(Subtema::where('id_tema', $id_tema)->get())->addIndexColumn()->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function edit(Subtema $subtema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subtema $subtema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subtema  $subtema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subtema $subtema)
    {
        //
    }
}
