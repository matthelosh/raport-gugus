<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tematik extends Model
{
    //
    protected $fillabel = ['tingkat_id', 'mapel_id', 'kd_id', 'tema_id', 'subtema_id', 'ket'];
    protected $hidden = ['created_at', 'updated_at'];
    public function mapels()
    {
        return $this->belongsTo('App\Mapel', 'mapel_id', 'kode_mapel');
    }

    public function kds()
    {
        return $this->belongsTo('App\Kd', 'kd_id', 'kode_kd');
    }

    public function temas()
    {   
        return $this->belongsTo('App\Tema', 'tema_id', 'kode_tema');
    }

    public function subtemas()
    {
        return $this->belongsTo('App\Subtema', 'subtema_id', 'kode_subtema');
    }
}
