<?php

namespace App\Filament\Admin\Resources\ReligionResource\Pages;

use App\Filament\Admin\Resources\ReligionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReligions extends ListRecords
{
    protected static string $resource = ReligionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
