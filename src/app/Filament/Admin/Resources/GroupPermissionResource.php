<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GroupPermissionResource\Pages;
use App\Filament\Admin\Resources\GroupPermissionResource\RelationManagers;
use App\Models\Acl\GroupPermission;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupPermissionResource extends Resource
{
    protected static ?string $model = GroupPermission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Group Permissions';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/group-permissions';
    public static ?string $label = 'Group Permissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('group_id')
                    ->relationship('group', 'group_name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('permission_id')
                    ->relationship('permission', 'action_code')
                    ->required(),
                Toggle::make('is_access')
                    ->label('Access Granted')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group.group_name')->label('Group'),
                TextColumn::make('permission.action_code')->label('Permission'),
                IconColumn::make('is_access')->boolean(),
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
            'index' => Pages\ListGroupPermissions::route('/'),
            'create' => Pages\CreateGroupPermission::route('/create'),
            'edit' => Pages\EditGroupPermission::route('/{record}/edit'),
        ];
    }
}
