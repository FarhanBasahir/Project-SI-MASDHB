<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Pengaturan extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static string $view = 'filament.pages.pengaturan';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Sistem';

    public ?array $data = [];

    public function mount(): void
    {
        // Ambil data dari database dan isi ke form
        $settings = Setting::all()->pluck('value', 'key')->toArray();
        $this->form->fill($settings);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tanggal_buka')
                    ->label('Tanggal Buka Pendaftaran'),
                DatePicker::make('tanggal_tutup')
                    ->label('Tanggal Tutup Pendaftaran'),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        // Simpan setiap pengaturan ke database
        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan')
            ->success()
            ->send();
    }
}
