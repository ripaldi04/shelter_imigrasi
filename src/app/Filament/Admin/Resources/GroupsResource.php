<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\GroupsResource\Pages;
use App\Filament\Admin\Resources\GroupsResource\RelationManagers;
use App\Models\Acl\Groups;
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

class GroupsResource extends Resource
{
    protected static ?string $model = Groups::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Groups';
    protected static ?string $navigationGroup = 'Acl';
    protected static ?string $slug = 'acl/groups';
    public static ?string $label = 'groups';
    public static function getRecordRouteKeyName(): string
    {
        return 'id'; // atau 'uuid' jika field kamu namanya 'uuid'
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('group_name')
                    ->label('Group Name')
                    ->required()
                    ->maxLength(100),

                Textarea::make('description')
                    ->label('Description')
                    ->rows(4)
                    ->columnSpanFull(),

                Toggle::make('is_publish')
                    ->label('Publish')
                    ->inline(false)
                    ->required(),

                Toggle::make('is_sub_publish')
                    ->label('Sub Publish')
                    ->inline(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group_name')
                    ->label('Group Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap(),

                IconColumn::make('is_publish')
                    ->label('Publish')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_sub_publish')
                    ->label('Sub Publish')
                    ->boolean()
                    ->sortable(),
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
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroups::route('/create'),
            'edit' => Pages\EditGroups::route('/{record}/edit'),
        ];
    }
}
