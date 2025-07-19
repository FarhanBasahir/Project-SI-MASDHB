<?php

namespace App\Filament\Resources\PendaftarResource\Pages;

use App\Exports\PendaftarExport; // <-- Tambahkan ini
use App\Filament\Resources\PendaftarResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Maatwebsite\Excel\Facades\Excel; // <-- Tambahkan ini

class ListPendaftars extends ListRecords
{
    protected static string $resource = PendaftarResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol "Buat Pendaftar" yang sudah ada
            Actions\CreateAction::make(),

            // Tambahkan Action baru untuk Export
            Actions\Action::make('export')
                ->label('Export ke Excel')
                ->action(function () {
                    return Excel::download(new PendaftarExport, 'data-pendaftar.xlsx');
                })
                ->color('success')
                ->icon('heroicon-o-document-arrow-down'),
        ];
    }
}
