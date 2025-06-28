<?php

namespace App\Filament\Admin\Resources\UsersReferenceResource\Pages;

use App\Filament\Admin\Resources\UsersReferenceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsersReferences extends ListRecords
{
    protected static string $resource = UsersReferenceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
