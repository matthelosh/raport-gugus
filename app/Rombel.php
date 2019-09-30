<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    //
    protected $fillable = [
        'kode_rombel', 'tingkat', 'nama_rombel', 'id_guru'
    ];
 
    public function mapels() {
        return $this->belongsToMany('App\Mapel', 'mapel_rombel', 'rombel_id', 'mapel_id');
    }
}
