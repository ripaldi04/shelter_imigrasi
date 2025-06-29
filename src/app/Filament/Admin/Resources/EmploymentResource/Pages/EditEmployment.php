<?php

namespace App\Filament\Admin\Resources\EmploymentResource\Pages;

use App\Filament\Admin\Resources\EmploymentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmployment extends EditRecord
{
    protected static string $resource = EmploymentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
