<?php

namespace App\Filament\Resources;

use App\Filament\Actions\AssesmentAction;
use App\Filament\Resources\AlternativeResource\Pages;
use App\Models\Alternative;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\MaxWidth;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AlternativeResource extends Resource
{
    protected static ?string $model = Alternative::class;

    protected static ?string $slug = 'alternatives';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Data Master';

    protected static ?string $navigationIcon = 'heroicon-o-light-bulb';

    protected static ?string $modelLabel = 'Alternatif';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->label('Kode kriteria')
                    ->prefix('A')
                    ->required()
                    ->numeric()
                    ->default(fn () => Alternative::max('code') + 1)
                    ->disabled()
                    ->dehydrated(),

                Forms\Components\TextInput::make('name')
                    ->label('Nama alternatif')
                    ->required()
                    ->maxLength(255),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Kode alternatif')
                    ->formatStateUsing(fn (string $state) => "A$state")
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama alternatif')
                    ->searchable()
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\TrashedFilter::make()
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    AssesmentAction::make(),
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
            ->defaultSort('code', 'asc');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageAlternatives::route('/'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScope(SoftDeletingScope::class);
    }
}
