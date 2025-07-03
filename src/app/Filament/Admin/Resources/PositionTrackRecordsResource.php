<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PositionTrackRecordsResource\Pages;
use App\Filament\Admin\Resources\PositionTrackRecordsResource\RelationManagers;
use App\Models\Employee\PositionTrackRecords;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
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

class PositionTrackRecordsResource extends Resource
{
    protected static ?string $model = PositionTrackRecords::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Position Track Records';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $slug = 'employee/position_track_record';
    public static ?string $label = 'Assortment Track Records';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_personnel_id')
                    ->relationship('personnel', 'employee_number')
                    ->required(),
                Select::make('organization_id')
                    ->relationship('organization', 'organization')
                    ->required(),
                Select::make('grade_id')
                    ->relationship('grade', 'grade')
                    ->required(),
                Select::make('position_id')
                    ->relationship('position', 'position') // pastikan `position()` relasi-nya tersedia di model
                    ->required(),
                Select::make('position_group_id')
                    ->relationship('positionGroup', 'name')
                    ->required(),
                TextInput::make('position_name')->required()->maxLength(150),
                TextInput::make('unit_name')->required()->maxLength(150),
                TextInput::make('instance')->required()->maxLength(150),

                DatePicker::make('tmt_date')->label('TMT'),
                TextInput::make('sk_number')->maxLength(100),
                DatePicker::make('sk_date')->label('Tanggal SK'),

                Textarea::make('description'),
                FileUpload::make('document_path')->directory('position_documents'),

                Toggle::make('is_internal')->label('Is Internal'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('position_name')->searchable(),
                TextColumn::make('unit_name'),
                TextColumn::make('tmt_date')->date(),
                TextColumn::make('sk_number'),
                BooleanColumn::make('is_internal'),
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
            'index' => Pages\ListPositionTrackRecords::route('/'),
            'create' => Pages\CreatePositionTrackRecords::route('/create'),
            'edit' => Pages\EditPositionTrackRecords::route('/{record}/edit'),
        ];
    }
}
