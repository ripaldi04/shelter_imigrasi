<?php

namespace App\Filament\Admin\Resources\UsersResource\Pages;

use App\Filament\Admin\Resources\UsersResource;
use App\Models\Acl\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateUsers extends CreateRecord
{
    protected static string $resource = UsersResource::class;
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Hash password, atau manipulasi data sebelum insert
        $data['password'] = bcrypt($data['password']);
        return $data;
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Buat record dan simpan ke database
        return User::create($data); // Penting! return record
    }
}
