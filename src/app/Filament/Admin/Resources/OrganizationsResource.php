<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\OrganizationsResource\Pages;
use App\Filament\Admin\Resources\OrganizationsResource\RelationManagers;
use App\Models\Instance\Organizations;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrganizationsResource extends Resource
{
    protected static ?string $model = Organizations::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Organizations';
    protected static ?string $navigationGroup = 'Instance';
    protected static ?string $slug = 'instance/organizations';
    public static ?string $label = 'Organizations';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('organization_code')->required()->maxLength(20),
                TextInput::make('organization')->required()->maxLength(250),
                TextInput::make('time_zone')->maxLength(50),
                TextInput::make('unor_id')->maxLength(50),

                Toggle::make('is_demo')->label('Is Demo'),
                Toggle::make('is_active')->label('Is Active')->default(true),

                TextInput::make('organization_code_kemenkeu')->maxLength(20),
                TextInput::make('organization_kemenkeu')->maxLength(250),
                TextInput::make('organization_code_bapenas')->maxLength(20),
                TextInput::make('organization_bapenas')->maxLength(250),
                TextInput::make('organization_code_anri')->maxLength(20),
                TextInput::make('organization_anri')->maxLength(250),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('organization_code')->sortable()->searchable(),
                TextColumn::make('organization')->sortable()->searchable(),
                IconColumn::make('is_active')->boolean(),
                IconColumn::make('is_demo')->boolean(),
                TextColumn::make('time_zone'),
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
            'index' => Pages\ListOrganizations::route('/'),
            'create' => Pages\CreateOrganizations::route('/create'),
            'edit' => Pages\EditOrganizations::route('/{record}/edit'),
        ];
    }
}
