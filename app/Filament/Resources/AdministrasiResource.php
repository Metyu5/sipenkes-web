<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdministrasiResource\Pages;
use App\Models\Administrasi;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Form; 
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdministrasiResource extends Resource
{
    protected static ?string $model = Administrasi::class;

    protected static ?string $navigationGroup = 'Manajemen Administrasi';
    protected static ?string $navigationLabel = 'Data Pasien';
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nomor_antrian')
                    ->label('Nomor Antrian')
                    ->disabled()
                    ->dehydrated(false),
                TextInput::make('nama_pasien')
                    ->label('Nama Pasien')
                    ->required(),
                Select::make('jenis_pelayanan')
                    ->options([
                        'BPJS' => 'BPJS',
                        'Umum' => 'Umum',
                    ])
                    ->required(),
                TextInput::make('poli_tujuan')
                    ->label('Poli Tujuan')
                    ->required(),
                Select::make('metode_kunjungan')
                    ->options([
                        'Datang Langsung' => 'Datang Langsung',
                        'Rujukan' => 'Rujukan',
                    ])
                    ->required(),
                DatePicker::make('tanggal_kunjungan')
                    ->required(),
                TimePicker::make('jam_kunjungan')
                    ->required(),
                TextInput::make('nomor_bpjs')
                    ->label('Nomor Kartu BPJS')
                    ->nullable(),
                Select::make('status_administrasi')
                    ->options([
                        'Diterima' => 'Diterima',
                        'Ditolak' => 'Ditolak',
                    ])
                    ->required(),
                TextInput::make('tekanan_darah')
                    ->label('Tekanan Darah')
                    ->nullable(),
                TextInput::make('denyut_nadi')
                    ->label('Denyut Nadi')
                    ->numeric()
                    ->nullable(),
                Textarea::make('keluhan_utama')
                    ->label('Keluhan Utama')
                    ->nullable(),
                Textarea::make('riwayat_penyakit')
                    ->label('Riwayat Penyakit')
                    ->nullable(),
                Textarea::make('riwayat_alergi')
                    ->label('Riwayat Alergi')
                    ->nullable(),
               
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_antrian')->label('Nomor Antrian'),
                TextColumn::make('nama_pasien')->label('Nama Pasien'),
                TextColumn::make('jenis_pelayanan')->label('Jenis Pelayanan'),
                TextColumn::make('status_administrasi')->label('Status Administrasi'),
                TextColumn::make('tekanan_darah')->label('Tekanan Darah'),
                TextColumn::make('denyut_nadi')->label('Denyut Nadi'),
                TextColumn::make('keluhan_utama')->label('Keluhan Utama'),
                TextColumn::make('riwayat_penyakit')->label('Riwayat Penyakit'),
                TextColumn::make('riwayat_alergi')->label('Riwayat Alergi'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(fn (Administrasi $record) => $record->forceDelete())
                    ->requiresConfirmation()
                    ->color('danger'),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->action(function (Collection $records) {
                        $records->each->forceDelete();
                    })
                    ->requiresConfirmation()
                    ->color('danger'),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdministrasis::route('/'),
            'create' => Pages\CreateAdministrasi::route('/create'),
            'edit' => Pages\EditAdministrasi::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
{
    return 'Tampilan Data Administrasi Pasien';
}
}
