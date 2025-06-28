<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GradesResource\Pages;
use App\Filament\Admin\Resources\GradesResource\RelationManagers;
use App\Models\Employee\Grades;
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

class GradesResource extends Resource
{
    protected static ?string $model = Grades::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $navigationLabel = 'Grades';
    protected static ?string $slug = 'employee/grades';
    public static ?string $label = 'Grades';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('code')->maxLength(10)->required(),
                TextInput::make('grade')->maxLength(50)->required(),
                TextInput::make('classification')->maxLength(50),
                Select::make('position_group_id')
                    ->label('Position Group')
                    ->relationship('positionGroup', 'name') // gunakan relasi & kolom display
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('unor_id')->maxLength(100),
                TextInput::make('level')->maxLength(5),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')->searchable(),
                TextColumn::make('grade'),
                TextColumn::make('classification'),
                TextColumn::make('level'),
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
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrades::route('/create'),
            'edit' => Pages\EditGrades::route('/{record}/edit'),
        ];
    }
}
