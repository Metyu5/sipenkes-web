<?php

namespace App\Filament\Resources\ResepDokterResource\Pages;

use App\Filament\Resources\ResepDokterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResepDokter extends EditRecord
{
    protected static string $resource = ResepDokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
