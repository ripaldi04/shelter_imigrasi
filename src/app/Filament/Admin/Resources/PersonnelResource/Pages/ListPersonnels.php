<?php

namespace App\Filament\Admin\Resources\PersonnelResource\Pages;

use App\Filament\Admin\Resources\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonnels extends ListRecords
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
