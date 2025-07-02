<?php

namespace App\Filament\Admin\Resources\MaritalStatusResource\Pages;

use App\Filament\Admin\Resources\MaritalStatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaritalStatus extends EditRecord
{
    protected static string $resource = MaritalStatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
