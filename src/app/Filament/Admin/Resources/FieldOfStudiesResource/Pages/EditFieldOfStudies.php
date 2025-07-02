<?php

namespace App\Filament\Admin\Resources\FieldOfStudiesResource\Pages;

use App\Filament\Admin\Resources\FieldOfStudiesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFieldOfStudies extends EditRecord
{
    protected static string $resource = FieldOfStudiesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
