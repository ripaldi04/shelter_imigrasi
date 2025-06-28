<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ActionResource\Pages;
use App\Filament\Admin\Resources\ActionResource\RelationManagers;
use App\Models\Acl\Action;
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

class ActionResource extends Resource
{
    protected static ?string $model = Action::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Actions';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/actions';
    public static ?string $label = 'Actions';
    public static function getRecordRouteKeyName(): string
    {
        return 'id'; // atau 'uuid' jika field kamu namanya 'uuid'
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('action_code')
                    ->label('Action Code')
                    ->required()
                    ->maxLength(25),

                TextInput::make('action_name')
                    ->label('Action Name')
                    ->required()
                    ->maxLength(50),

                TextInput::make('indicator')
                    ->label('Indicator')
                    ->maxLength(50),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('action_code')
                    ->label('Code')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('action_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('indicator')
                    ->label('Indicator')
                    ->wrap(),

                TextColumn::make('description')
                    ->label('Description')
                    ->wrap()
                    ->limit(50)
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
            'index' => Pages\ListActions::route('/'),
            'create' => Pages\CreateAction::route('/create'),
            'edit' => Pages\EditAction::route('/{record}/edit'),
        ];
    }
}
