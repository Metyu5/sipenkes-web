<?php

namespace App\Filament\Resources\DataAdministrasiResource\Pages;

use App\Filament\Resources\DataAdministrasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDataAdministrasi extends EditRecord
{
    protected static string $resource = DataAdministrasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
