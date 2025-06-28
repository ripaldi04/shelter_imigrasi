<?php

namespace App\Filament\Admin\Resources\AssortmentsResource\Pages;

use App\Filament\Admin\Resources\AssortmentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAssortments extends EditRecord
{
    protected static string $resource = AssortmentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
