<?php

namespace App\Exports;

use App\Rombel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportRombel implements FromCollection, WithHeadings
{

    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Rombel::query()
                ->leftJoin('users', 'rombels.id_guru', '=', 'users.nip')
                ->select('rombels.id', 'rombels.kode_rombel', 'rombels.nama_rombel', 'users.fullname', 'rombels.tingkat')
                ->where('users.level', 'guru')
                ->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Kode Rombel', 'Nama Rombel', 'Wali Kelas', 'Kelas'
        ];
    }
}
