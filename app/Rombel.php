<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    //
    protected $fillable = [
        'kode_rombel', 'tingkat', 'nama_rombel', 'id_guru'
    ];

    public function guru() {
        $this->belongsTo('App\User', 'id_guru', 'nip');
    }
}
