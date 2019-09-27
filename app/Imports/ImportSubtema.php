<?php

namespace App\Imports;

use App\Subtema;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportSubtema implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Subtema([
            //
            'id_semester'=>$row['id_semester'], 'id_tingkat' =>$row['id_tingkat'], 'id_tema'=>$row['id_tema'], 'kode_subtema'=>$row['kode_subtema'], 'teks_subtema'=>$row['teks_subtema']
        ]);
    }

    public function onError(\Exception $e)
    {
        return $e;
    }
}
