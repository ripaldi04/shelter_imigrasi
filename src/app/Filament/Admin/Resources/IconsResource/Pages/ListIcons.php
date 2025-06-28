<?php

namespace App\Filament\Admin\Resources\IconsResource\Pages;

use App\Filament\Admin\Resources\IconsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIcons extends ListRecords
{
    protected static string $resource = IconsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
