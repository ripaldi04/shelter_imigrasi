<?php

namespace App\Filament\Admin\Resources\PositionsResource\Pages;

use App\Filament\Admin\Resources\PositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPositions extends EditRecord
{
    protected static string $resource = PositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
