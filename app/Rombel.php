<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    //
    protected $fillable = [
        'kode_rombel', 'id_tingkat', 'nama_rombel', 'id_guru'
    ]
}
