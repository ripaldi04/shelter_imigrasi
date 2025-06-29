<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\EmploymentResource\Pages;
use App\Filament\Admin\Resources\EmploymentResource\RelationManagers;
use App\Models\Public\Employment;
use Filament\Forms;
use Filament\Forms\Components\Textarea;
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

class EmploymentResource extends Resource
{
    protected static ?string $model = Employment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Public';
    protected static ?string $navigationLabel = 'Employment';
    protected static ?string $slug = 'public/employment';
    public static ?string $label = 'Employment';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('employment')
                    ->required()
                    ->maxLength(100),
                Textarea::make('description'),
                TextInput::make('unor_id')->maxLength(100),
                Toggle::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('employment')->searchable(),
                TextColumn::make('description')->limit(30),
                TextColumn::make('unor_id'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
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
            'index' => Pages\ListEmployments::route('/'),
            'create' => Pages\CreateEmployment::route('/create'),
            'edit' => Pages\EditEmployment::route('/{record}/edit'),
        ];
    }
}
