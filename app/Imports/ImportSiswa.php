<?php

namespace App\Imports;

use App\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class ImportSiswa implements ToModel,  WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Siswa([
            //
            'nis' => $row['nis'], 'nisn' => $row['nisn'], 'nama_siswa' => $row['nama_siswa'], 'jk' => $row['jk'], 'tempat_lahir' => $row['tempat_lahir'], 'tanggal_lahir' => $row['tanggal_lahir'], 'agama' => $row['agama'], 'alamat' => $row['alamat'], 'asal_sekolah' => $row['asal_sekolah'], 'id_rombel' => $row['id_rombel'], 'id_ortu' => $row['id_ortu']
        ]);
    }

    public function onError(\Throwable $e)
    {
        return $e;
    }
}
