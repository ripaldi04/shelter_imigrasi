<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UsersResource\Pages;
use App\Filament\Admin\Resources\UsersResource\RelationManagers;
use App\Models\Acl\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Users';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/users';
    public static ?string $label = 'Users';
    public static function getRecordRouteKeyName(): string
    {
        return 'id'; // atau 'uuid' jika field kamu namanya 'uuid'
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('username')
                    ->label('Username')
                    ->required(),
                TextInput::make('password')
                    ->label('Password')
                    ->required(),
                TextInput::make('name')
                    ->label('name')
                    ->required(),
                TextInput::make('email')
                    ->label('email')
                    ->required(),
                Select::make('is_active')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif'
                    ])
                    ->required(),
                select::make('is_change_password')
                    ->label('is change password')
                    ->options([
                        1 => 'Aktif',
                        0 => 'Tidak Aktif'
                    ])
                    ->required(),
                TextInput::make('description')
                    ->label('description')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('username')->label('Username')->searchable()->sortable(),
                TextColumn::make('name')->label('Nama')->searchable()->sortable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(), // otomatis tampil ikon cek/silang
                IconColumn::make('is_change_password')
                    ->label('Harus Ganti Password')
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUsers::route('/create'),
            'edit' => Pages\EditUsers::route('/{record}/edit'),
        ];
    }
}
