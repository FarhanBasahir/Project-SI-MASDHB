<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MateriResource\Pages;
use App\Filament\Resources\MateriResource\RelationManagers;
use App\Models\Materi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MateriResource extends Resource
{
    protected static ?string $model = Materi::class;

    // Pengaturan Navigasi & Label
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationGroup = 'Akademik';
    protected static ?string $navigationLabel = 'Materi';
    protected static ?string $modelLabel = 'Materi';
    protected static ?string $pluralModelLabel = 'Materi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('kelas_id')
                    ->label('Kelas')
                    ->relationship('kelas', 'nama_kelas')
                    ->required(),
                Forms\Components\Select::make('mata_pelajaran_id')
                    ->label('Mata Pelajaran')
                    ->relationship('mataPelajaran', 'nama_mapel')
                    ->required(),
                Forms\Components\TextInput::make('judul')
                    ->required()
                    ->maxLength(255),
                Forms\Components\RichEditor::make('deskripsi')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Upload File Materi (Opsional)')
                    ->directory('materi-files'),
                Forms\Components\TextInput::make('link_url')
                    ->label('Link Eksternal (Opsional)')
                    ->url()
                    ->maxLength(255)
                    ->helperText('Contoh: Link video YouTube, artikel, dll.'),
                Forms\Components\Select::make('user_id')
                    ->label('Guru Pengunggah')
                    ->relationship('user', 'name', modifyQueryUsing: fn ($query) => $query->where('role', 'guru'))
                    ->searchable()
                    ->required()
                    ->default(auth()->user()?->id),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('judul')->searchable(),
                Tables\Columns\TextColumn::make('kelas.nama_kelas')->sortable(),
                Tables\Columns\TextColumn::make('mataPelajaran.nama_mapel')->label('Mata Pelajaran')->sortable(),
                Tables\Columns\TextColumn::make('user.name')->label('Guru')->sortable(),
                Tables\Columns\IconColumn::make('file_path')->label('File')->boolean(),
                Tables\Columns\IconColumn::make('link_url')->label('Link')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMateris::route('/'),
            'create' => Pages\CreateMateri::route('/create'),
            'edit' => Pages\EditMateri::route('/{record}/edit'),
        ];
    }
}
