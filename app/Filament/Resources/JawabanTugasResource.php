<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JawabanTugasResource\Pages;
use App\Filament\Resources\JawabanTugasResource\RelationManagers;
use App\Models\JawabanTugas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JawabanTugasResource extends Resource
{
    protected static ?string $model = JawabanTugas::class;

    // Pengaturan Navigasi & Label
    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Jawaban Tugas';
    protected static ?string $modelLabel = 'Jawaban Tugas';
    protected static ?string $pluralModelLabel = 'Jawaban Tugas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field ini hanya untuk ditampilkan, tidak bisa diedit
                Forms\Components\Select::make('tugas_id')
                    ->relationship('tugas', 'judul')
                    ->disabled(),
                Forms\Components\Select::make('user_id')
                    ->label('Siswa')
                    ->relationship('user', 'name')
                    ->disabled(),
                Forms\Components\Textarea::make('jawaban_teks')
                    ->label('Jawaban Teks')
                    ->disabled()
                    ->columnSpanFull(),
                // Guru hanya bisa mengisi nilai dan catatan
                Forms\Components\TextInput::make('nilai')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100),
                Forms\Components\RichEditor::make('catatan_guru')
                    ->label('Catatan / Feedback Guru')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tugas.judul')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Siswa')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nilai')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('Nilai'), // Mengubah label tombol
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false; // Guru tidak bisa membuat jawaban, hanya bisa menilai
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListJawabanTugas::route('/'),
            'edit' => Pages\EditJawabanTugas::route('/{record}/edit'),
        ];
    }    
}
