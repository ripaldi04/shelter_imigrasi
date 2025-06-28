<?php

namespace App\Filament\Admin\Resources\AssortmentsResource\Pages;

use App\Filament\Admin\Resources\AssortmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAssortments extends ListRecords
{
    protected static string $resource = AssortmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
