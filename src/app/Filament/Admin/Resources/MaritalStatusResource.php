<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MaritalStatusResource\Pages;
use App\Filament\Admin\Resources\MaritalStatusResource\RelationManagers;
use App\Models\Public\MaritalStatus;
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

class MaritalStatusResource extends Resource
{
    protected static ?string $model = MaritalStatus::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Marital Status';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $slug = 'public/marital-status';
    public static ?string $label = 'Marital Status';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('marital_status')
                    ->required()
                    ->maxLength(50),

                TextInput::make('unor_id')
                    ->label('UNOR ID')
                    ->maxLength(100)
                    ->nullable(),

                Textarea::make('description')
                    ->maxLength(65535)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('marital_status')->searchable()->sortable(),
                TextColumn::make('unor_id')->label('UNOR ID')->toggleable(),
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
            'index' => Pages\ListMaritalStatuses::route('/'),
            'create' => Pages\CreateMaritalStatus::route('/create'),
            'edit' => Pages\EditMaritalStatus::route('/{record}/edit'),
        ];
    }
}
