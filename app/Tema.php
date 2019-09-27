<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    //
    protected $fillable = ['id_semester', 'id_tingkat', 'kode_tema', 'teks_tema'];

    public function subtema() {
        $this->hasMany('App\Subtema', 'id_tema', 'id');
    }

    public function mapel(){
        $this->hasMany('App\Mapel', 'id_tema', 'id');
    }

    public function rombel() {
        $this->belongsTo('App\Rombel', 'id_tingkat', 'tingkat');
    }
}
