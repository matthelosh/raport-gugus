<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    //
    protected $fillable = ['id_semester', 'id_tingkat', 'kode_tema', 'teks_tema'];

    public function subtemas() {
       return $this->hasMany('App\Subtema', 'id_tema', 'kode_tema');
    }

    public function mapels(){
       return $this->hasMany('App\Mapel', 'tematik', 'mapel_id', 'tema_id');
    }

    public function rombel() {
       return $this->belongsToMany('App\Rombel', 'id_tingkat', 'tingkat');
    }
}
