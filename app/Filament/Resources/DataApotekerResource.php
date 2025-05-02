<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataApotekerResource\Pages;
use App\Models\DataApoteker;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Collection;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DataApotekerResource extends Resource
{
    protected static ?string $model = DataApoteker::class;

    protected static ?string $navigationLabel = 'Petugas Apoteker';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Manajemen Apoteker';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama_depan')
                    ->label('Nama Depan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('nama_belakang')
                    ->label('Nama Belakang')
                    ->required()
                    ->maxLength(255),

                TextInput::make('NIP')
                    ->label('NIP')
                    ->required()
                    ->maxLength(50),

                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('password')
                    ->label('Password')
                    ->password()
                    ->required()
                    ->minLength(8)
                    ->maxLength(255)
                    ->dehydrateStateUsing(fn($state) => Hash::make($state)),

                DatePicker::make('tanggal_mendaftar')
                    ->label('Tanggal Mendaftar')
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto')
                    ->image()
                    ->directory('apotekers')
                    ->maxSize(1024)
                    ->required(),
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

                TextColumn::make('nama_depan')
                    ->label('Nama Depan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('nama_belakang')
                    ->label('Nama Belakang')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('NIP')
                    ->label('NIP')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tanggal_mendaftar')
                    ->label('Tanggal Mendaftar')
                    ->date(),

                ImageColumn::make('foto')
                    ->label('Foto'),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->action(fn(DataApoteker $record) => $record->forceDelete())
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
            'index' => Pages\ListDataApotekers::route('/'),
            'create' => Pages\CreateDataApoteker::route('/create'),
            'edit' => Pages\EditDataApoteker::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Tampilan Data Petugas Apoteker';
    }
}
