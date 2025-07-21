<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendaftarResource\Pages;
use App\Models\Pendaftar;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\FileUpload; // <-- Tambahkan ini
use Filament\Tables\Columns\ImageColumn;  // <-- Tambahkan ini
use Pages\ListPendaftars;

class PendaftarResource extends Resource
{
    protected static ?string $model = Pendaftar::class;
    protected static ?string $navigationIcon = 'heroicon-o-academic-cap'; // Icon di navigasi

    protected static ?string $slug = 'pendaftar';
    protected static ?string $navigationLabel = 'Pendaftar';
    protected static ?string $pluralModelLabel = 'Pendaftar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_pendaftaran')->required()->unique(ignoreRecord: true),
                Forms\Components\TextInput::make('nama_lengkap')->required(),
                Forms\Components\TextInput::make('nisn')->required()->numeric()->unique(ignoreRecord: true),
                Forms\Components\Select::make('jenis_kelamin')->options(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'])->required(),
                Forms\Components\TextInput::make('tempat_lahir')->required(),
                Forms\Components\DatePicker::make('tanggal_lahir')->required(),
                Forms\Components\TextInput::make('asal_sekolah')->required(),
                // Tambahkan field lain sesuai kebutuhan (data orang tua, dll)
                Forms\Components\Textarea::make('alamat')->columnSpanFull(),
                Forms\Components\Select::make('status_pendaftaran')
                    ->options([
                        'Menunggu Verifikasi' => 'Menunggu Verifikasi',
                        'Terverifikasi' => 'Terverifikasi',
                        'Lulus' => 'Lulus',
                        'Ditolak' => 'Ditolak',
                    ])->required(),
                // Tambahkan upload dokumen
                FileUpload::make('dokumen_ijazah')
                    ->label('Ijazah / SKL')
                    ->disk('public') // Menyimpan di storage/app/public
                    ->directory('dokumen-ijazah') // Di dalam folder public
                    ->visibility('public') // Agar bisa diakses dari URL
                    ->columnSpanFull(),

                FileUpload::make('dokumen_foto')
                    ->label('Pas Foto 3x4')
                    ->disk('public')
                    ->directory('dokumen-foto')
                    ->image() // Memberitahu Filament ini adalah gambar
                    ->imageEditor() // Memberi fitur edit gambar sederhana
                    ->columnSpanFull(),

                FileUpload::make('dokumen_kk')
                    ->label('Kartu Keluarga')
                    ->disk('public')
                    ->directory('dokumen-kk')
                    ->visibility('public')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_pendaftaran')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('nama_lengkap')->searchable(),
                Tables\Columns\TextColumn::make('nisn')->searchable(),
                Tables\Columns\TextColumn::make('asal_sekolah'),
                Tables\Columns\BadgeColumn::make('status_pendaftaran')
                    ->colors([
                        'warning' => 'Menunggu Verifikasi',
                        'success' => 'Lulus',
                        'danger' => 'Ditolak',
                        'primary' => 'Terverifikasi',
                    ]),
                // Tambahkan kolom gambar untuk foto
                ImageColumn::make('dokumen_foto')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(), // Menampilkan gambar dalam bentuk lingkaran
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_pendaftaran')
                    ->options([
                        'Menunggu Verifikasi' => 'Menunggu Verifikasi',
                        'Terverifikasi' => 'Terverifikasi',
                        'Lulus' => 'Lulus',
                        'Ditolak' => 'Ditolak',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(), // Tambahkan action untuk melihat detail
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Nanti bisa tambahkan relasi ke dokumen di sini
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPendaftars::route('/'),
            'create' => Pages\CreatePendaftar::route('/create'),
            'edit' => Pages\EditPendaftar::route('/{record}/edit'),
        ];
    }
}
