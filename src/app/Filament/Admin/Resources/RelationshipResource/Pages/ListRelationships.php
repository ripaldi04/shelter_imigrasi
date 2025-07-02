<?php

namespace App\Filament\Admin\Resources\RelationshipResource\Pages;

use App\Filament\Admin\Resources\RelationshipResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelationships extends ListRecords
{
    protected static string $resource = RelationshipResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
