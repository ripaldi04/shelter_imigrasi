<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RewardTrackRecordsResource\Pages;
use App\Filament\Admin\Resources\RewardTrackRecordsResource\RelationManagers;
use App\Models\Employee\RewardTrackRecords;
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

class RewardTrackRecordsResource extends Resource
{
    protected static ?string $model = RewardTrackRecords::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Reward Track Records';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $slug = 'employee/reward-track-records';
    public static ?string $label = 'Reward Track Records';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('reward_name')->required()->maxLength(255),
                Select::make('employee_personnel_id')
                    ->relationship('personnel', 'employee_number')
                    ->required(),
                Select::make('award_type_id')
                    ->relationship('awardType', 'name') // pastikan kolom 'name' tersedia
                    ->required(),
                TextInput::make('institution')->maxLength(150),
                TextInput::make('year')->maxLength(4),
                TextInput::make('sk_giver')->maxLength(100),
                TextInput::make('sk_number')->maxLength(100),
                DatePicker::make('sk_date'),
                Textarea::make('description'),
                FileUpload::make('document_path')
                    ->label('Dokumen / Gambar')
                    ->disk('public') 
                    ->directory('uploads/rewards')
                    ->preserveFilenames()
                    ->openable()
                    ->downloadable()
                    ->visibility('public')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reward_name')->searchable(),
                TextColumn::make('personnel.employee_number')->label('Employee'),
                TextColumn::make('institution'),
                TextColumn::make('year'),
                TextColumn::make('sk_date')->date(),
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
            'index' => Pages\ListRewardTrackRecords::route('/'),
            'create' => Pages\CreateRewardTrackRecords::route('/create'),
            'edit' => Pages\EditRewardTrackRecords::route('/{record}/edit'),
        ];
    }
}
