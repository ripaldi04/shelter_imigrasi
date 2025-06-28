<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UsersReferenceResource\Pages;
use App\Filament\Admin\Resources\UsersReferenceResource\RelationManagers;
use App\Models\Acl\UserReference;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersReferenceResource extends Resource
{
    protected static ?string $model = UserReference::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'User Reference';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/user-reference';
    public static ?string $label = 'User Reference';
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
                    ->relationship('user', 'username') // Pastikan ada relasi `user()` di model
                    ->searchable()
                    ->required(),
                TextInput::make('secret')
                    ->label('Secret')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.username')
                    ->label('Username')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('secret')
                    ->label('Secret')
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
            'index' => Pages\ListUsersReferences::route('/'),
            'create' => Pages\CreateUsersReference::route('/create'),
            'edit' => Pages\EditUsersReference::route('/{record}/edit'),
        ];
    }
}
