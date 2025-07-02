<?php

namespace App\Filament\Admin\Resources\OccupationResource\Pages;

use App\Filament\Admin\Resources\OccupationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOccupation extends EditRecord
{
    protected static string $resource = OccupationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
