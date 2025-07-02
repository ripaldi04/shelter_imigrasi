<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PersonalResource\Pages;
use App\Filament\Admin\Resources\PersonalResource\RelationManagers;
use App\Models\Identity\Personal;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PersonalResource extends Resource
{
    protected static ?string $model = Personal::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Identity';
    protected static ?string $navigationLabel = 'Personal';
    protected static ?string $slug = 'identity/personal';
    public static ?string $label = 'Personal';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('acl_user_id')
                    ->relationship('user', 'username')->searchable(),
                Select::make('employee_personnel_id')
                    ->relationship('personnel', 'employee_number')->searchable(),
                TextInput::make('full_name')->required()->maxLength(255),
                TextInput::make('front_title')->maxLength(25),
                TextInput::make('back_degree')->maxLength(50),
                TextInput::make('non_academic_degree')->maxLength(50),
                TextInput::make('personal_email')->email()->maxLength(100),
                TextInput::make('phone_number')->maxLength(20),
                TextInput::make('wa_number')->maxLength(20),
                TextInput::make('home_number')->maxLength(20),
                TextInput::make('place_of_birth')->maxLength(100),
                DatePicker::make('date_of_birth'),

                TextInput::make('blood_type')->maxLength(2),
                Textarea::make('identity_address'),
                Textarea::make('address'),
                Select::make('gender')
                    ->options([
                        '1' => 'Laki-laki',
                        '0' => 'Perempuan',
                    ]),
                TextInput::make('identity_number')->maxLength(16),
                TextInput::make('family_identity_number')->maxLength(16),

                FileUpload::make('photo_path')->image(),
                FileUpload::make('identity_card_path')->label('Scan KTP')->acceptedFileTypes(['application/pdf', 'image/*']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fullname')->searchable(),
                TextColumn::make('gender'),
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
            'index' => Pages\ListPersonals::route('/'),
            'create' => Pages\CreatePersonal::route('/create'),
            'edit' => Pages\EditPersonal::route('/{record}/edit'),
        ];
    }
}
