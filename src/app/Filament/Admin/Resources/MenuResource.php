<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MenuResource\Pages;
use App\Filament\Admin\Resources\MenuResource\RelationManagers;
use App\Models\Acl\Menu;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Menu';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/menu';
    public static ?string $label = 'Menu';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('menu_code')->required()->maxLength(50),
                TextInput::make('menu_name')->required()->maxLength(250),
                Select::make('parent_id')
                    ->label('Parent Menu')
                    ->relationship('parent', 'menu_name')
                    ->searchable()
                    ->preload(),
                TextInput::make('url')->maxLength(100),
                TextInput::make('sequence_no')->numeric()->default(0),
                TextInput::make('icon_name')->maxLength(50),
                Toggle::make('is_display')->label('Display')->default(false),
                Textarea::make('description')->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('menu_code')->sortable()->searchable(),
                TextColumn::make('menu_name')->sortable()->searchable(),
                TextColumn::make('parent.menu_name')->label('Parent'),
                TextColumn::make('url'),
                TextColumn::make('sequence_no'),
                IconColumn::make('is_display')->boolean(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
