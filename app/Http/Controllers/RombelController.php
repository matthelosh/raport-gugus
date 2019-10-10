<?php

namespace App\Http\Controllers;

use App\Exports\ExportRombel;
use Illuminate\Http\Request;
use App\Rombel;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;



class RombelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.dashadmin', ['page' => 'rombels']);
    }
    public function allRombels()
    {
        $level = Auth::user()->level;
        if ($level == 'guru') {

        } else {
            return DataTables::of(DB::table('rombels')
                                ->join('users', 'rombels.id_guru', '=', 'users.nip')
                                ->select('rombels.*', 'users.nip as id_guru', 'users.fullname as nama_guru')
                                ->get()
                            )->addIndexColumn()->make(true);
        }
    }

    public function selRombel(Request $request) {
        if($request->has('q')) {
            $rombels = Rombel::where('nama_rombel', 'LIKE', '%'.$request->query('q').'%')->get();
            return response()->json($rombels);
        } 
        else if($request->has('_type')){
            $rombels = Rombel::all();
            return response()->json($rombels);
        }
        else {
            $rombel = Rombel::where('kode_rombel', $request->query('kode'))->first();
            return response()->json($rombel);
        }
    }
    
    public function create(Request $request)
    {
        try {
            Rombel::create([
                'kode_rombel' => $request->input('kode_rombel'),
                'nama_rombel' => $request->input('nama_rombel'),
                'tingkat'     => $request->input('tingkat'),
                'id_guru'     => $request->input('id_guru')  
            ]);

            return response()->json(['status' => 'sukses', 'msg' => 'Rombel baru: '.$request->input('nama_rombel').' berhasil dibuat.']);
        }
        catch(\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => 'Gagal Membuat Rombel Baru', 'data' => $e->getMessage()]);
        }
        finally {
            // return response()->json(['status' => 'sukses', 'msg' => 'Rombel baru: '.$request->input('nama_rombel').' berhasil dibuat.']);
        }
    }

    public function deleteOne(Request $request)
    {
        try {
            $id = $request->query('id');
            Rombel::destroy($id);

            return response()->json(['status' => 'sukses', 'msg' => 'Rombel berhasil dihapus']);
        }
        catch(\Exception $e) {
            return response(500)->json(['status' => 'gagal', 'msg' => 'Gagal Menghapus Rombel', 'data' => $e->getMessage()]);
        }
        
    }

    // Update One ROmbel
    public function updateOne(Request $request)
    {
        $id = $request->input('id');
       try {
           Rombel::find($id)->update([
               'kode_rombel' => $request->input('kode_rombel'),
               'nama_rombel' => $request->input('nama_rombel'),
               'tingkat'    => $request->input('tingkat'),
               'id_guru'    => $request->input('id_guru')
           ]);

           return response()->json(['status' => 'sukses', 'msg' => 'Data Rombel berhasil diperbarui']);
       }
       catch (\Exception $e) {
            return response()->json(['status' => 'gagal', 'msg' => 'Data Rombel gagal diperbarui', 'data' => $e->getMessage()]);
       }
    }

    public function export(Request $request)
    {
        return Excel::download(new ExportRombel, 'data_rombel.xlsx');
    }
}
