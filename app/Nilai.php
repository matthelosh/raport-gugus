<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    //
    protected $fillable = [
        'kode_nilai','tapel', 'semester', 'periode', 'rombel_id', 'mapel_id', 'subtema_id', 'kd_id', 'aspek_id', 'tipe_nilai_id', 'guru_id', 'siswa_id', 'nilai'
    ];

    public function siswas()
    {
        return $this->belongsTo(\App\Siswa, 'siswa_id', 'nisn');
    }
    public function gurus()
    {
        return $this->belongsTo(\App\User, 'guru_id', 'nip');
    }
    public function mapels()
    {
        return $this->belongsTo(\App\Mapel, 'mapel_id', 'kode_mapel');
    }
}
