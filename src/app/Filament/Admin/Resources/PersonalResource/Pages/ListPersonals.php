<?php

namespace App\Filament\Admin\Resources\PersonalResource\Pages;

use App\Filament\Admin\Resources\PersonalResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPersonals extends ListRecords
{
    protected static string $resource = PersonalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
