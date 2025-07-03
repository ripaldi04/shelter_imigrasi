<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\AssortmentTrackRecordsResource\Pages;
use App\Filament\Admin\Resources\AssortmentTrackRecordsResource\RelationManagers;
use App\Models\Employee\AssortmentTrackRecords;
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

class AssortmentTrackRecordsResource extends Resource
{
    protected static ?string $model = AssortmentTrackRecords::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Assortment Track Records';
    protected static ?string $navigationGroup = 'Employee';
    protected static ?string $slug = 'employee/assortments-track-records';
    public static ?string $label = 'Assortments Track Records';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                DatePicker::make('tmt_date')->label('TMT')->required(),

                TextInput::make('work_period_month')->label('Masa Kerja (Bulan)')->required()->numeric(),
                TextInput::make('work_period_year')->label('Masa Kerja (Tahun)')->required()->numeric(),

                TextInput::make('sk_number')->label('Nomor SK')->maxLength(150),
                TextInput::make('description')->label('Keterangan')->maxLength(255),

                FileUpload::make('document_path')
                    ->label('Dokumen SK')
                    ->disk('public')
                    ->directory('rank_documents')
                    ->preserveFilenames()
                    ->acceptedFileTypes(['application/pdf', 'image/*'])
                    ->maxSize(2048),

                Select::make('employee_personnel_id')
                    ->relationship('personnel', 'employee_number')
                    ->required(),
                Select::make('employment_id')->relationship('employment', 'employment')->required(),
                Select::make('assortment_id')->relationship('assortment', 'assortment')->required(),
                Select::make('promotion_type_id')->relationship('promotionType', 'name')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tmt_date')->label('TMT'),
                TextColumn::make('work_period_month')->label('Bulan'),
                TextColumn::make('work_period_year')->label('Tahun'),
                TextColumn::make('sk_number')->label('Nomor SK'),
                TextColumn::make('employment.employment')->label('Status Kepegawaian'),
                TextColumn::make('assortment.assortment')->label('Pangkat/Golongan'),
                TextColumn::make('promotionType.name')->label('Jenis Kenaikan'),
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
            'index' => Pages\ListAssortmentTrackRecords::route('/'),
            'create' => Pages\CreateAssortmentTrackRecords::route('/create'),
            'edit' => Pages\EditAssortmentTrackRecords::route('/{record}/edit'),
        ];
    }
}
