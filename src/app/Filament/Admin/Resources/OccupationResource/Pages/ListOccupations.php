<?php

namespace App\Filament\Admin\Resources\OccupationResource\Pages;

use App\Filament\Admin\Resources\OccupationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOccupations extends ListRecords
{
    protected static string $resource = OccupationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
