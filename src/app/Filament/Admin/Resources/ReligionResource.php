<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReligionResource\Pages;
use App\Filament\Admin\Resources\ReligionResource\RelationManagers;
use App\Models\Public\Religion;
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

class ReligionResource extends Resource
{
    protected static ?string $model = Religion::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Religion';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $slug = 'public/religion';
    public static ?string $label = 'Religion';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('religion')
                    ->required()
                    ->maxLength(100),

                Textarea::make('description')
                    ->maxLength(65535)
                    ->nullable(),

                TextInput::make('unor_id')
                    ->maxLength(100)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('religion')->searchable()->sortable(),
                TextColumn::make('description')->limit(40)->toggleable(),
                TextColumn::make('unor_id'),
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
            'index' => Pages\ListReligions::route('/'),
            'create' => Pages\CreateReligion::route('/create'),
            'edit' => Pages\EditReligion::route('/{record}/edit'),
        ];
    }
}
