<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PermissionResource\Pages;
use App\Filament\Admin\Resources\PermissionResource\RelationManagers;
use App\Models\Acl\Permission;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Permissions';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/permissions';
    public static ?string $label = 'Permissions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('action_code')
                    ->label('Action Code')
                    ->required()
                    ->maxLength(25),

                TextInput::make('menu_code')
                    ->label('Menu Code')
                    ->required()
                    ->maxLength(50),

                TextInput::make('sequence_no')
                    ->label('Sequence No')
                    ->numeric()
                    ->default(0)
                    ->required(),

                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('action_code')->label('Action')->searchable(),
                TextColumn::make('menu_code')->label('Menu')->searchable(),
                TextColumn::make('sequence_no')->label('Sequence No')->sortable(),
                TextColumn::make('description')->label('Description')->limit(30),
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
            'index' => Pages\ListPermissions::route('/'),
            'create' => Pages\CreatePermission::route('/create'),
            'edit' => Pages\EditPermission::route('/{record}/edit'),
        ];
    }
}
