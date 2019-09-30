<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kd extends Model
{
    //
    protected $fillable = ['kode_kd', 'teks_kd', 'id_mapel', 'tingkat', 'ki_id'];
    public function mapels() 
    {
        return $this->belongsTo('App\Mapel', 'kode_mapel', 'id_mapel');
    }
}
