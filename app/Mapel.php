<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    //
    protected $fillable = [
        'kode_mapel', 'nama_mapel'
    ];

    public function rombels() {
        return $this->belongsToMany('App\Rombel', 'mapel_rombel', 'mapel_id', 'rombel_id');
    }
    public function tingkats() {
        return $this->belongsToMany('App\Tingkat', 'mapel_tingkat', 'mapel_id', 'tingkat_id');
    }

    public function kds()
    {
        return $this->hasMany('App\Kd', 'kode_mapel', 'id_mapel');
    }
    
}
