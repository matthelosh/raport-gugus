<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    //
    protected $fillable = [
    	'nis', 'nisn', 'nama_siswa', 'jk', 'tempat_lahir', 'tanggal_lahir', 'agama', 'alamat', 'asal_sekolah', 'id_rombel', 'id_ortu'
    ];

    public function ortus(){
    	$this->belongsTo('App\Ortu', 'id_ortu', 'id');
    }
}
