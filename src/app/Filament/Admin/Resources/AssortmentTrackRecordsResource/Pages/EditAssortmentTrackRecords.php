<?php

namespace App\Filament\Admin\Resources\AssortmentTrackRecordsResource\Pages;

use App\Filament\Admin\Resources\AssortmentTrackRecordsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssortmentTrackRecords extends EditRecord
{
    protected static string $resource = AssortmentTrackRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
