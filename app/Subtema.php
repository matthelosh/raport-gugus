<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subtema extends Model
{
    //
    protected $fillable = [
        'id_semester', 'id_tingkat', 'id_tema', 'kode_subtema', 'teks_subtema'
    ];

    public function tema(){
        $this->belongsTo('App\Tema', 'id_tema', 'kode_tema');
    }

    // public function kd() {
    //     $this->hasMany
    // }
}
