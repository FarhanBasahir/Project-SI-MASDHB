<?php

// database/migrations/xxxx_create_calon_siswas_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_pendaftaran')->unique();
            $table->string('nama_lengkap');
            $table->string('nisn')->unique();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->text('alamat');
            $table->string('asal_sekolah');
            $table->string('nama_ayah');
            $table->string('pekerjaan_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ibu');
            $table->string('nomor_hp_ortu');
            $table->enum('status_pendaftaran', ['Menunggu Verifikasi', 'Terverifikasi', 'Lulus', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftar');
    }
};
