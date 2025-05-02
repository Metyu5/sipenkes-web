<?php

namespace App\Filament\Resources\ResepDokterResource\Pages;

use App\Filament\Resources\ResepDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResepDokters extends ListRecords
{
    protected static string $resource = ResepDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
