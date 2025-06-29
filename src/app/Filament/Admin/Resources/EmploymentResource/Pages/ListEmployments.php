<?php

namespace App\Filament\Admin\Resources\EmploymentResource\Pages;

use App\Filament\Admin\Resources\EmploymentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmployments extends ListRecords
{
    protected static string $resource = EmploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
