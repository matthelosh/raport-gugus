<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    //
    protected $fillable = ['kelas'];

    public function mapels() {
        return $this->belongsToMany('App\Mapel', 'mapel_tingkat', 'tingkat_id', 'mapel_id');
    }
}
