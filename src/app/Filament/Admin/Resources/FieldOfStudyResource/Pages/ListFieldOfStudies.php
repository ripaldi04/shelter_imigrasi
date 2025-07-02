<?php

namespace App\Filament\Admin\Resources\FieldOfStudyResource\Pages;

use App\Filament\Admin\Resources\FieldOfStudyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFieldOfStudies extends ListRecords
{
    protected static string $resource = FieldOfStudyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
