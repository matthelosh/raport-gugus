<?php

namespace App\Http\Controllers;

use App\Sekolah;
use Illuminate\Http\Request;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function home(\App\Sekolah $sekolah)
    {
        $sekolah = $sekolah;
        return view('umum.beranda');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sekolah = Sekolah::where('active', '1')->first();
        return view('dashboard.dashadmin', ['page'=>'sekolah', 'data' => $sekolah]);
    }

    public function getData(Request $request)
    {
        try {
            $sekolah = Sekolah::first();
            return response()->json(['status' => 'sukses', 'msg' => 'Data Sekolah ditemukan', 'data' => $sekolah]);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => 'Data Sekolah tidak ditemukan', 'err' => $e->getMess]);
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
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function show(Sekolah $sekolah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        try {
            Sekolah::where('id', 1)->update([
                'nss' => $request->input('nss'),
                'npsn' => $request->input('npsn'),
                'nama_sekolah' => $request->input('nama_sekolah'),
                'alamat_jl' => $request->input('alamat_jl'),
                'alamat_desa' => $request->input('alamat_desa'),
                'alamat_kec' => $request->input('alamat_kec'),
                'alamat_kab' => $request->input('alamat_kab'),
                'alamat_prov' => $request->input('alamat_prov'),
                'telp' => $request->input('telp'),
                'email' => $request->input('email'),
                'website' => $request->input('website')
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Data Sekolah Berhasil diperbarui']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sekolah  $sekolah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        //
    }
}
