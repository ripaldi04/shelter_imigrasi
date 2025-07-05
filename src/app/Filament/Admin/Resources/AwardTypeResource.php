<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AwardTypeResource\Pages;
use App\Filament\Admin\Resources\AwardTypeResource\RelationManagers;
use App\Models\Public\AwardType;
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

class AwardTypeResource extends Resource
{
    protected static ?string $model = AwardType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $slug = 'public/award-type';
    public static ?string $label = 'Award Type';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(100),
                TextInput::make('unor_id')
                    ->maxLength(100)
                    ->label('UNOR ID'),
                Textarea::make('description'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('unor_id')->label('UNOR ID'),
                TextColumn::make('description')->label('Description')->toggleable(),
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
            'index' => Pages\ListAwardTypes::route('/'),
            'create' => Pages\CreateAwardType::route('/create'),
            'edit' => Pages\EditAwardType::route('/{record}/edit'),
        ];
    }
}
