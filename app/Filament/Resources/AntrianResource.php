<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AntrianResource\Pages;
use App\Models\Antrian;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\TextColumn;

class AntrianResource extends Resource
{
    protected static ?string $model = Antrian::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationLabel = 'Antrian';
    protected static ?string $navigationGroup = 'Manajemen Administrasi';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('nomor_antrian')
                ->label('Nomor Antrian')
                ->disabled()
                ->dehydrated(false),


                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Belum Diproses' => 'Belum Diproses',
                        'Diproses' => 'Diproses',
                        'Selesai' => 'Selesai',
                    ])
                    ->required(),

                    Select::make('jenis_pelayanan')
                    ->label('Jenis Pelayanan')
                    ->options([
                        'BPJS' => 'BPJS',
                        'Umum' => 'Umum',
                    ])
                    ->required()
                    ->default(null) 
                    ->native(false)
                    ->placeholder('Pilih Jenis Pelayanan')
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('nomor_antrian')->label('No. Antrian')->sortable(),
                TextColumn::make('status')->label('Status')->badge(),
                TextColumn::make('administrasi.jenis_pelayanan')->label('Jenis Pelayanan'),
                TextColumn::make('created_at')->label('Tanggal')->dateTime(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(fn (Antrian $record) => $record->forceDelete())
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
    

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAntrians::route('/'),
            'create' => Pages\CreateAntrian::route('/create'),
            'edit' => Pages\EditAntrian::route('/{record}/edit'),
        ];
    }
    public static function getModelLabel(): string
{
    return 'Antrian';
}

public static function getPluralModelLabel(): string
{
    return 'Tampilan Data Antrian';
}

}
