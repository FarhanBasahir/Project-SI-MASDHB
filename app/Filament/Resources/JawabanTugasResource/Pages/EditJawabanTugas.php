<?php

namespace App\Filament\Resources\JawabanTugasResource\Pages;

use App\Filament\Resources\JawabanTugasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJawabanTugas extends EditRecord
{
    protected static string $resource = JawabanTugasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
