<?php

namespace App\Filament\Admin\Resources\PositionsResource\Pages;

use App\Filament\Admin\Resources\PositionsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPositions extends ListRecords
{
    protected static string $resource = PositionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
