<?php

namespace App\Exports;

use App\Siswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSiswa implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    // public function __construct(int $id)
    // {
    //     $this->id = $id;
    // }
    public function collection() 
    {
        return Siswa::query()
                    ->leftJoin('ortus', 'siswas.id_ortu', '=', 'ortus.id')
                    ->leftJoin('rombels', 'siswas.id_rombel', '=', 'rombels.kode_rombel')
                    ->select('siswas.nis', 'siswas.nisn', 'siswas.nama_siswa','siswas.jk','siswas.tempat_lahir', 'siswas.tanggal_lahir', 'siswas.agama', 'siswas.alamat', 'siswas.asal_sekolah', 'siswas.id_rombel', 'ortus.id as idOrtu', 'ortus.nama_ayah', 'ortus.nama_ibu', 'ortus.job_ayah', 'ortus.job_ibu', 'ortus.hp_ortu', 'ortus.alamat_jl', 'ortus.alamat_desa', 'ortus.alamat_kec', 'ortus.alamat_kab', 'ortus.alamat_prov', 'ortus.nama_wali', 'ortus.job_wali', 'ortus.alamat_wali', 'ortus.hp_wali', 'rombels.kode_rombel', 'rombels.nama_rombel')
                    ->get();
    }

    public function headings(): array
    {
        return ['No', 'NIS', 'NISN', 'Nama', 'JK', 'tempat Lahir', 'Tanggal Lahir', 'Agama', 'Asal Sekolah', 'ID Rombel','idOrtu', 'Nama Ayah', 'Nama Ibu', 'Pekerjaan Ayah', 'Pekerjaan Ibu', 'Hp Ortu', 'Jl', 'Desa', 'Kec', 'Kab', 'Prov', 'Nama Wali', 'Pekerjaan Wali', 'Alamat Wali', 'HP Wali'];
    }
    // public function headings() array {
    //     return ["id", "nis", "nisn", "nama_siswa", "jk", "tempat_lahir", "tanggal_lahir", "agama", "alamat", "asal_sekolah", "id_rombel", "idOrtu", "nama_ayah", "nama_ibu", "job_ayah", "job_ibu", "hp_ortu", "alamat_jl", "alamat_desa", "alamat_kec", "alamat_kab", "alamat_prov", "nama_wali", "job_wali", "alamat_wali", "hp_wali"];
    // }
}
