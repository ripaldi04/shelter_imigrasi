<?php

namespace App\Filament\Admin\Resources\RewardTrackRecordsResource\Pages;

use App\Filament\Admin\Resources\RewardTrackRecordsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRewardTrackRecords extends ListRecords
{
    protected static string $resource = RewardTrackRecordsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
