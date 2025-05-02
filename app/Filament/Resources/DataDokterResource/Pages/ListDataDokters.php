<?php

namespace App\Filament\Resources\DataDokterResource\Pages;

use App\Filament\Resources\DataDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataDokters extends ListRecords
{
    protected static string $resource = DataDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
