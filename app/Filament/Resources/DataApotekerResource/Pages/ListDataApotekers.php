<?php

namespace App\Filament\Resources\DataApotekerResource\Pages;

use App\Filament\Resources\DataApotekerResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataApotekers extends ListRecords
{
    protected static string $resource = DataApotekerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
