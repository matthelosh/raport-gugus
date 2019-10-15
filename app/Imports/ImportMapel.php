<?php

namespace App\Imports;

use App\Mapel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportMapel implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Mapel([
            //
            'kode_mapel' => $row['kode_mapel'], 'nama_mapel' => $row['nama_mapel']
        ]);
    }

    public function onError(\Exception $e) {
        return $e;
    }
}
