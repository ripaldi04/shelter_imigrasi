<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UserGroupsResource\Pages;
use App\Filament\Admin\Resources\UserGroupsResource\RelationManagers;
use App\Models\Acl\UserGroups;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserGroupsResource extends Resource
{
    protected static ?string $model = UserGroups::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'User Groups';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/user-groups';
    public static ?string $label = 'User Groups';
    public static function getRecordRouteKeyName(): string
    {
        return 'id'; // atau 'uuid' jika field kamu namanya 'uuid'
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'username') // Sesuaikan dengan relasi di model
                    ->searchable()
                    ->required(),

                Select::make('group_id')
                    ->label('Group')
                    ->relationship('group', 'group_name') // Sesuaikan dengan relasi di model
                    ->searchable()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->label('User')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('group.group_name')
                    ->label('Group')
                    ->searchable()
                    ->sortable(),
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
            'index' => Pages\ListUserGroups::route('/'),
            'create' => Pages\CreateUserGroups::route('/create'),
            'edit' => Pages\EditUserGroups::route('/{record}/edit'),
        ];
    }
}
