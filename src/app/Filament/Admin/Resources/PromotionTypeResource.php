<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PromotionTypeResource\Pages;
use App\Filament\Admin\Resources\PromotionTypeResource\RelationManagers;
use App\Models\Public\PromotionType;
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

class PromotionTypeResource extends Resource
{
    protected static ?string $model = PromotionType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Promotion Type';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $slug = 'public/promotion-type';
    public static ?string $label = 'Promotion Type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->maxLength(100),
                Textarea::make('description')->maxLength(500),
                TextInput::make('unor_id')->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('unor_id'),
                TextColumn::make('description')->limit(50)->toggleable(),
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
            'index' => Pages\ListPromotionTypes::route('/'),
            'create' => Pages\CreatePromotionType::route('/create'),
            'edit' => Pages\EditPromotionType::route('/{record}/edit'),
        ];
    }
}
