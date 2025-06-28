<?php

namespace App\Filament\Admin\Resources\GroupPermissionResource\Pages;

use App\Filament\Admin\Resources\GroupPermissionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGroupPermissions extends ListRecords
{
    protected static string $resource = GroupPermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
