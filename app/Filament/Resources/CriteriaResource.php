<?php

namespace App\Filament\Resources;

use App\Enums\CriteriaType;
use App\Filament\Resources\CriteriaResource\Pages;
use App\Models\Criteria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CriteriaResource extends Resource
{
    protected static ?string $model = Criteria::class;

    protected static ?string $slug = 'criterias';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Master';

    protected static ?string $navigationIcon = 'heroicon-o-funnel';

    protected static ?string $modelLabel = 'Kriteria';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode kriteria')
                    ->prefix('C')
                    ->required()
                    ->numeric()
                    ->default(fn () => Criteria::max('code') + 1)
                    ->disabled()
                    ->dehydrated(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama kriteria')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('weight')
                    ->label('Bobot kriteria')
                    ->required()
                    ->numeric()
                    ->inputMode('decimal')
                    ->rule('regex:/^\d{1,2}(\.\d{1,2})?$/')
                    ->placeholder('0.00'),

                Forms\Components\Select::make('type')
                    ->label('Jenis kriteria')
                    ->required()
                    ->options(collect(CriteriaType::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->toArray())
                    ->native(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode kriteria')
                    ->formatStateUsing(fn (string $state) => "C$state")
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama kriteria')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('weight')
                    ->label('Bobot kriteria')
                    ->badge()
                    ->color('success')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe kriteria')
                    ->badge()
                    ->formatStateUsing(fn ($state) => CriteriaType::tryFrom($state)?->label() ?? 'Unknown')
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'info',
                        '1' => 'warning',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe kriteria')
                    ->multiple()
                    ->options(collect(CriteriaType::cases())->mapWithKeys(fn ($c) => [$c->value => $c->label()])->toArray())
                    ->native(false),

                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
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
            ->defaultSort('code', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageCriterias::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }
}
