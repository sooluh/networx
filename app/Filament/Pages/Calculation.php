<?php

namespace App\Filament\Pages;

use App\Models\Alternative;
use App\Models\Criteria;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Calculation extends Page implements HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $title = 'Matriks';

    protected static ?string $slug = 'calculations';

    protected static ?string $navigationIcon = 'heroicon-o-calculator';

    protected static string $view = 'filament.pages.calculation';

    protected static ?string $navigationGroup = 'Perhitungan';

    protected static ?string $modelLabel = 'Matriks';

    protected static ?int $navigationSort = 4;

    protected function getTableQuery()
    {
        return Alternative::query()->with('assesments.subcriteria', 'assesments.criteria');
    }

    protected function getTableColumns(): array
    {
        $criteriaList = Criteria::all();

        $columns = [
            TextColumn::make('code')->label('Kode')->formatStateUsing(fn (string $state) => "A$state"),
            TextColumn::make('name')->label('Alternatif'),
        ];

        foreach ($criteriaList as $criteria) {
            $columns[] = TextColumn::make("C$criteria->code")
                ->label("C$criteria->code")
                ->getStateUsing(function ($record) use ($criteria) {
                    $assesment = $record->assesments->firstWhere('criteria_id', $criteria->id);

                    return $assesment && $assesment->subcriteria ? $assesment->subcriteria->value : '-';
                });
        }

        return $columns;
    }

    protected function table(Table $table): Table
    {
        return $table
            ->columns($this->getTableColumns())
            ->query($this->getTableQuery())
            ->paginated(false);
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
