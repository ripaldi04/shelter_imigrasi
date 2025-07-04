<?php

namespace App\Filament\Admin\Resources\EmploymentTypeResource\Pages;

use App\Filament\Admin\Resources\EmploymentTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploymentType extends EditRecord
{
    protected static string $resource = EmploymentTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
