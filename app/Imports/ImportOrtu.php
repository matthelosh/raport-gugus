<?php

namespace App\Imports;

use App\Ortu;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class ImportOrtu implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ortu([
            //
            'nama_ayah'     => $row['nama_ayah'],
            'nama_ibu'      => $row['nama_ibu'],
            'job_ayah'      => $row['job_ayah'],
            'job_ibu'       => $row['job_ibu'],
            'alamat_jl'     => $row['alamat_jl'],
            'alamat_desa'   => $row['alamat_desa'],
            'alamat_kec'    => $row['alamat_kec'],
            'alamat_kab'    => $row['alamat_kab'],
            'alamat_prov'   => $row['alamat_prov'],
            'hp_ortu'       => $row['hp_ortu'],
            'nama_wali'     => $row['nama_wali'],
            'job_wali'      => $row['job_wali'],
            'alamat_wali'   => $row['alamat_wali'],
            'hp_wali'       => $row['hp_wali']
        ]);
    }

    public function onError(\Throwable $e)
    {
        return $e;
    }
}
