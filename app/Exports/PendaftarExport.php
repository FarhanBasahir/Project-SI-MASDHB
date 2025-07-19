<?php

namespace App\Exports;

use App\Models\Pendaftar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendaftarExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Memilih kolom yang ingin diexport
        return Pendaftar::select(
            'nomor_pendaftaran', 'nama_lengkap', 'nisn', 'jenis_kelamin', 
            'tempat_lahir', 'tanggal_lahir', 'asal_sekolah', 'status_pendaftaran',
            'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu', 'nomor_hp_ortu'
        )->get();
    }

    public function headings(): array
    {
        // Menentukan nama header untuk setiap kolom
        return [
            'Nomor Pendaftaran', 'Nama Lengkap', 'NISN', 'Jenis Kelamin',
            'Tempat Lahir', 'Tanggal Lahir', 'Asal Sekolah', 'Status Pendaftaran',
            'Nama Ayah', 'Pekerjaan Ayah', 'Nama Ibu', 'Pekerjaan Ibu', 'Nomor HP Ortu'
        ];
    }
}