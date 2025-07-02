<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OccupationResource\Pages;
use App\Filament\Admin\Resources\OccupationResource\RelationManagers;
use App\Models\Public\Occupation;
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

class OccupationResource extends Resource
{
    protected static ?string $model = Occupation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Occupation';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $slug = 'public/occupation';
    public static ?string $label = 'Occupation';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('occupation')
                    ->required()
                    ->maxLength(150),

                Textarea::make('description')
                    ->maxLength(65535)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('occupation')->searchable()->sortable(),
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
            'index' => Pages\ListOccupations::route('/'),
            'create' => Pages\CreateOccupation::route('/create'),
            'edit' => Pages\EditOccupation::route('/{record}/edit'),
        ];
    }
}
