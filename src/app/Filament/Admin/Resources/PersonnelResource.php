<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PersonnelResource\Pages;
use App\Filament\Admin\Resources\PersonnelResource\RelationManagers;
use App\Models\Employee\Personnel;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonnelResource extends Resource
{
    protected static ?string $model = Personnel::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Personnel';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $slug = 'employee/personnel';
    public static ?string $label = 'Personnel';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employee_number')->required()->maxLength(18),
                TextInput::make('old_employee_number')->maxLength(18),
                TextInput::make('office_email')->email()->maxLength(100),
                Textarea::make('assignment_letter_path'),

                TextInput::make('unor_id')->maxLength(50),

                Select::make('employment_id')
                    ->relationship('employment', 'employment') // pastikan relasinya ada
                    ->required(),

                Select::make('assortment_id')
                    ->relationship('assortment', 'assortment')
                    ->required(),

                Select::make('position_id')
                    ->relationship('position', 'position'),

                Select::make('organization_id')
                    ->relationship('organization', 'organization'),

                Select::make('employment_type_id')
                    ->relationship('employmentType', 'name'),

                Toggle::make('is_verified')->label('Verified'),
                Toggle::make('is_external')->label('External'),

                Textarea::make('notes'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employee_number')->searchable(),
                TextColumn::make('office_email'),
                TextColumn::make('employment.employment')->label('Status'),
                TextColumn::make('assortment.assortment')->label('Assortment'),
                TextColumn::make('position.position')->label('Position'),
                TextColumn::make('organization.organization')->label('organizations'),
                BooleanColumn::make('is_verified'),
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
            'index' => Pages\ListPersonnels::route('/'),
            'create' => Pages\CreatePersonnel::route('/create'),
            'edit' => Pages\EditPersonnel::route('/{record}/edit'),
        ];
    }
}
