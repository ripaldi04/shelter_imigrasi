<?php

namespace App\Filament\Admin\Resources\PositionTrackRecordsResource\Pages;

use App\Filament\Admin\Resources\PositionTrackRecordsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositionTrackRecords extends EditRecord
{
    protected static string $resource = PositionTrackRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
