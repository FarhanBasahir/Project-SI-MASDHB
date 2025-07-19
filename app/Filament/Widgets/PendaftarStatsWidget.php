<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftar;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PendaftarStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pendaftar', Pendaftar::count())
                ->description('Semua siswa yang telah mendaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('primary'),

            Stat::make('Pendaftar Lulus', Pendaftar::where('status_pendaftaran', 'Lulus')->count())
                ->description('Jumlah siswa yang diterima')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Menunggu Verifikasi', Pendaftar::where('status_pendaftaran', 'Menunggu Verifikasi')->count())
                ->description('Siswa yang datanya perlu diperiksa')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            // TAMBAHKAN KODE INI
            Stat::make('Pendaftar Ditolak', Pendaftar::where('status_pendaftaran', 'Ditolak')->count())
                ->description('Jumlah siswa yang tidak diterima')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}
