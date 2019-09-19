<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ortu extends Model
{
    //
    protected $fillable = [
    	'nama_ayah', 'nama_ibu', 'job_ayah', 'job_ibu', 'alamat_jl', 'alamat_desa', 'alamat_kec', 'alamat_kab', 'alamat_prov', 'hp_ortu', 'nama_wali', 'job_wali', 'alamat_wali', 'hp_wali'
    ];

    public function siswas(){
    	$this->hasMany('App\Siswa', 'id_ortu', 'id');
    }
}
