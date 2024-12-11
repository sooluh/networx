<?php

namespace App\Filament\Pages;

use App\Models\Result as ResultModel;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Result extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $title = 'Hasil Akhir';

    protected static ?string $slug = 'results';

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    protected static string $view = 'filament.pages.result';

    protected static ?string $navigationGroup = 'Perhitungan';

    protected static ?string $modelLabel = 'Hasil Akhir';

    protected static ?int $navigationSort = 5;

    public function getTopResultProperty()
    {
        return ResultModel::query()->orderBy('rank', 'asc')->first();
    }

    protected function getTableQuery()
    {
        return ResultModel::query();
    }

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('rank')
                ->label('Rank')
                ->sortable(),

            TextColumn::make('name')
                ->label('Alternatif')
                ->formatStateUsing(fn (ResultModel $record) => "C$record->code - $record->name")
                ->sortable(),

            TextColumn::make('yi')
                ->label('Nilai Yi')
                ->sortable()
                ->formatStateUsing(fn ($state) => number_format($state, 3)),
        ];
    }

    protected function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->query($this->getTableQuery())
            ->paginated(false)
            ->defaultSort('rank', 'asc');
    }

    protected function getTableActions(): array
    {
        return [];
    }

    protected function getTableHeaderActions(): array
    {
        return [];
    }

    protected function getTableBulkActions(): array
    {
        return [];
    }
}
