<?php

namespace App\Imports;

use App\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Support\Facades\Hash;

class ImportUser implements ToModel, WithHeadingRow, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            //
            'nip'=>$row['nip'], 'username'=>$row['username'], 'fullname' => $row['fullname'],'foto' => '0', 'hp' => $row['hp'], 'level' => $row['level'], 'isActive' => $row['aktif'], 'email' => $row['email'], 'password' => Hash::make($row['password'])

        ]);
    }

    public function onError(\Throwable $e)
    {
        return $e;
    }
}
