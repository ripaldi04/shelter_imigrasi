<?php

namespace App\Filament\Admin\Resources\UserGroupsResource\Pages;

use App\Filament\Admin\Resources\UserGroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserGroups extends ListRecords
{
    protected static string $resource = UserGroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
