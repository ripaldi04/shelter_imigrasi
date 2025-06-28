<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AssortmentsResource\Pages;
use App\Filament\Admin\Resources\AssortmentsResource\RelationManagers;
use App\Models\Employee\Assortments;
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

class AssortmentsResource extends Resource
{
    protected static ?string $model = Assortments::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Assortment';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $slug = 'employee/assortments';
    public static ?string $label = 'Assortments';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')
                    ->label('Code')
                    ->maxLength(10)
                    ->required(),

                TextInput::make('assortment')
                    ->label('Assortment') // label opsional
                    ->maxLength(100)
                    ->required(),

                TextInput::make('position')
                    ->label('Position')
                    ->maxLength(100),

                TextInput::make('unor_id')
                    ->label('Unit Organization ID')
                    ->maxLength(100),

                Textarea::make('description')
                    ->label('Description')
                    ->maxLength(200),

                TextInput::make('sequence_no')
                    ->numeric()
                    ->label('Sequence No'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable()->sortable(),
                TextColumn::make('assortment')->label('Employment Type')->searchable(),
                TextColumn::make('position')->searchable(),
                TextColumn::make('unor_id')->label('Unit Org')->toggleable(),
                TextColumn::make('sequence_no')->sortable(),
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
            'index' => Pages\ListAssortments::route('/'),
            'create' => Pages\CreateAssortments::route('/create'),
            'edit' => Pages\EditAssortments::route('/{record}/edit'),
        ];
    }
}
