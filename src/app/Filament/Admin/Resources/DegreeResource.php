<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DegreeResource\Pages;
use App\Filament\Admin\Resources\DegreeResource\RelationManagers;
use App\Models\Public\Degree;
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

class DegreeResource extends Resource
{
    protected static ?string $model = Degree::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $navigationLabel = 'Degree';
    protected static ?string $slug = 'public/degree';
    public static ?string $label = 'Degree';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('degree')
                    ->required()
                    ->maxLength(50),

                TextInput::make('level')
                    ->numeric()
                    ->required(),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->maxLength(65535)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('degree')->searchable()->sortable(),
                TextColumn::make('level')->sortable(),
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
            'index' => Pages\ListDegrees::route('/'),
            'create' => Pages\CreateDegree::route('/create'),
            'edit' => Pages\EditDegree::route('/{record}/edit'),
        ];
    }
}
