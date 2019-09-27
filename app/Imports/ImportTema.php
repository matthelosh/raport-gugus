<?php

namespace App\Imports;

use App\Tema;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class ImportTema implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Tema([
            //
            'id_semester' => $row['id_semester'],
            'id_tingkat' => $row['id_tingkat'],
            'kode_tema' => $row['kode_tema'],
            'teks_tema' => $row['teks_tema']
        ]);
    }

    public function onError(\Exception $e)
    {
        return $e;
    }
}
