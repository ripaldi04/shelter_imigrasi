<?php

namespace App\Filament\Admin\Resources\UserGroupsResource\Pages;

use App\Filament\Admin\Resources\UserGroupsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserGroups extends EditRecord
{
    protected static string $resource = UserGroupsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
