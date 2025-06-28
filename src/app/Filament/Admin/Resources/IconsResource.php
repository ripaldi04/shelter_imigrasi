<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\IconsResource\Pages;
use App\Filament\Admin\Resources\IconsResource\RelationManagers;
use App\Models\Acl\Icons;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class IconsResource extends Resource
{
    protected static ?string $model = Icons::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Icons';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/icons';
    public static ?string $label = 'Icons';
    public static function getRecordRouteKeyName(): string
    {
        return 'id'; // atau 'uuid' jika field kamu namanya 'uuid'
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('icon_name')
                    ->label('Icon Name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('groups')
                    ->label('Groups')
                    ->maxLength(255),

                TextInput::make('pack_name')
                    ->label('Pack Name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('icon_name')
                    ->label('Icon Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('groups')
                    ->label('Groups')
                    ->sortable()
                    ->wrap(),

                TextColumn::make('pack_name')
                    ->label('Pack Name')
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
            'index' => Pages\ListIcons::route('/'),
            'create' => Pages\CreateIcons::route('/create'),
            'edit' => Pages\EditIcons::route('/{record}/edit'),
        ];
    }
}
