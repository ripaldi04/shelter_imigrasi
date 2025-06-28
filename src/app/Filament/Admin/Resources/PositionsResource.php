<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PositionsResource\Pages;
use App\Filament\Admin\Resources\PositionsResource\RelationManagers;
use App\Models\Instance\Positions;
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

class PositionsResource extends Resource
{
    protected static ?string $model = Positions::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Positions';
    protected static ?string $navigationGroup = 'Instance';
    protected static ?string $slug = 'instance/positions';
    public static ?string $label = 'Positions';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('position')
                    ->required()
                    ->maxLength(255),

                Select::make('grade_id')
                    ->relationship('grade', 'grade') // pastikan relasi `grade()` ada
                    ->searchable()
                    ->preload(),

                Select::make('class_id')
                    ->relationship('class', 'class') // pastikan relasi `class()` ada
                    ->searchable()
                    ->preload(),

                TextInput::make('unor_id')
                    ->maxLength(50),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('position')->searchable()->sortable(),
                TextColumn::make('grade.grade')->label('Grade'),
                TextColumn::make('class.class')->label('Class'),
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
            'index' => Pages\ListPositions::route('/'),
            'create' => Pages\CreatePositions::route('/create'),
            'edit' => Pages\EditPositions::route('/{record}/edit'),
        ];
    }
}
