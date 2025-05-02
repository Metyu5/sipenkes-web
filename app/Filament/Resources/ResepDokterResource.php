<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResepDokterResource\Pages;
use Illuminate\Support\Collection;
use App\Models\ResepDokter;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ResepDokterResource extends Resource
{
    protected static ?string $model = ResepDokter::class;
    protected static ?string $navigationLabel = 'Resep Dokter';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Manajemen Dokter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('dokter_id')
                    ->label('Nama Dokter Pemeriksa')
                    ->relationship('dokter', 'id')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->nama_lengkap)
                    ->searchable()
                    ->required(),
                Select::make('administrasi_id')
                    ->label('Nama Pasien')
                    ->relationship('administrasi', 'nama_pasien') // pastikan field ini ada di tabel administrasi
                    ->searchable()
                    ->required(),
                DatePicker::make('tanggal_resep')
                    ->label('Tanggal Resep')
                    ->required(),
                TextInput::make('nama_obat')
                    ->label('Nama Obat')
                    ->required(),
                TextInput::make('dosis')
                    ->label('Dosis')
                    ->required(),
                TextInput::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->required(),
                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex()
                    ->sortable(),
                TextColumn::make('dokter.nama_lengkap')->label('Dokter'),
                TextColumn::make('administrasi.nama_pasien')->label('Pasien'),
                TextColumn::make('tanggal_resep')->label('Tanggal Resep')->date(),
                TextColumn::make('nama_obat')->label('Obat'),
                TextColumn::make('dosis')->label('Dosis'),
                TextColumn::make('keterangan')->label('Keterangan'),
                TextColumn::make('jumlah')->label('Jumlah'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(fn(ResepDokter $record) => $record->forceDelete())
                    ->requiresConfirmation()
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->action(function (Collection $records) {
                            $records->each->forceDelete();
                        })
                        ->requiresConfirmation()
                        ->color('danger'),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListResepDokters::route('/'),
            'create' => Pages\CreateResepDokter::route('/create'),
            'edit' => Pages\EditResepDokter::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
{
    return 'Tampilan Resep Dokter';
}
}
