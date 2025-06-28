<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ClassesResource\Pages;
use App\Filament\Admin\Resources\ClassesResource\RelationManagers;
use App\Models\Instance\Classes;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClassesResource extends Resource
{
    protected static ?string $model = Classes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Classes';
    protected static ?string $navigationGroup = 'Instance';
    protected static ?string $slug = 'instance/classes';
    public static ?string $label = 'Classes';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('class')->numeric()->required(),
                TextInput::make('performance_allowance')->maxLength(20),
                TextInput::make('description')->maxLength(150),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('class')->sortable(),
                TextColumn::make('performance_allowance'),
                TextColumn::make('description'),
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasses::route('/create'),
            'edit' => Pages\EditClasses::route('/{record}/edit'),
        ];
    }
}
