<?php

namespace App\Filament\Admin\Resources\FieldOfStudiesResource\Pages;

use App\Filament\Admin\Resources\FieldOfStudiesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFieldOfStudies extends ListRecords
{
    protected static string $resource = FieldOfStudiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
