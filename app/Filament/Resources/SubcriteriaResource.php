<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubcriteriaResource\Pages;
use App\Models\Criteria;
use App\Models\Subcriteria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubcriteriaResource extends Resource
{
    protected static ?string $model = Subcriteria::class;

    protected static ?string $slug = 'subcriterias';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $modelLabel = 'Sub Kriteria';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('criteria_id')
                    ->label('Kriteria')
                    ->relationship('criteria', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->options(function () {
                        return Criteria::all()->pluck('name', 'id')->mapWithKeys(function ($name, $id) {
                            $code = Criteria::query()->select('code')->find($id)->code;

                            return [$id => "C$code - $name"];
                        });
                    }),

                Forms\Components\TextInput::make('name')
                    ->label('Nama sub kriteria')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('value')
                    ->label('Nilai sub kriteria')
                    ->required()
                    ->numeric()
                    ->placeholder('1-5'),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama sub kriteria')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('value')
                    ->label('Nilai sub kriteria')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make()->modalWidth(MaxWidth::Large),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ForceDeleteAction::make(),
                    Tables\Actions\RestoreAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->groups([
                Tables\Grouping\Group::make('criteria.code')
                    ->label('Kode Kriteria')
                    ->titlePrefixedWithLabel(false)
                    ->getTitleFromRecordUsing(fn (Subcriteria $record) => 'C'.$record->criteria->code.' - '.$record->criteria->name),
            ])
            ->defaultGroup('criteria.code');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageSubcriterias::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }
}
