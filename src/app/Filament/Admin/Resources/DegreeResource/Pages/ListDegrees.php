<?php

namespace App\Filament\Admin\Resources\DegreeResource\Pages;

use App\Filament\Admin\Resources\DegreeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDegrees extends ListRecords
{
    protected static string $resource = DegreeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
