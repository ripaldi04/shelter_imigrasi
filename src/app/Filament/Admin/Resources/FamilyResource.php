<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FamilyResource\Pages;
use App\Filament\Admin\Resources\FamilyResource\RelationManagers;
use App\Models\Identity\Family;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyResource extends Resource
{
    protected static ?string $model = Family::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Identity';
    protected static ?string $navigationLabel = 'Family';
    protected static ?string $slug = 'identity/family';
    public static ?string $label = 'Family';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('identity_number')->required()->maxLength(16),
                TextInput::make('full_name')->required()->maxLength(255),
                Select::make('gender')
                    ->options([
                        '1' => 'Laki-laki',
                        '0' => 'Perempuan',
                    ])
                    ->required(),
                TextInput::make('place_of_birth')->maxLength(100),
                DatePicker::make('date_of_birth'),
                TextInput::make('description')->maxLength(150),
                DatePicker::make('wedding_date'),

                FileUpload::make('identity_card')->directory('family/identity_card')->preserveFilenames(),
                FileUpload::make('family_card')->directory('family/family_card')->preserveFilenames(),
                FileUpload::make('relationship_card')->directory('family/relationship_card')->preserveFilenames(),
                FileUpload::make('birth_certificate')->directory('family/birth_certificate')->preserveFilenames(),

                TextInput::make('blood_type')->maxLength(2),

                TextInput::make('employee_personnel_id')->uuid(),
                TextInput::make('relationship_id')->uuid(),
                TextInput::make('marital_status_id')->uuid(),
                TextInput::make('degree_id')->uuid(),
                TextInput::make('field_of_study')->uuid(),
                TextInput::make('religion_id')->uuid(),
                TextInput::make('occupation_id')->uuid(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('identity_number')->searchable(),
                TextColumn::make('full_name')->searchable(),
                TextColumn::make('gender')->label('JK'),
                TextColumn::make('date_of_birth')->date(),
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
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
