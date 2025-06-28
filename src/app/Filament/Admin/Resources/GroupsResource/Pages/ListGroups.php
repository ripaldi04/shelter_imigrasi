<?php

namespace App\Filament\Admin\Resources\GroupsResource\Pages;

use App\Filament\Admin\Resources\GroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroups extends ListRecords
{
    protected static string $resource = GroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
