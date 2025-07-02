<?php

namespace App\Filament\Admin\Resources\MaritalStatusResource\Pages;

use App\Filament\Admin\Resources\MaritalStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMaritalStatuses extends ListRecords
{
    protected static string $resource = MaritalStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
