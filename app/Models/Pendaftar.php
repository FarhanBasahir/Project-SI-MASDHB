<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pendaftaran',
        'nama_lengkap',
        'nisn',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'alamat',
        'asal_sekolah',
        'nama_ayah',
        'pekerjaan_ayah',
        'nama_ibu',
        'pekerjaan_ibu',
        'nomor_hp_ortu',
        'status_pendaftaran',
        'dokumen_ijazah',
        'dokumen_foto',
        'dokumen_kk',
    ];
}
