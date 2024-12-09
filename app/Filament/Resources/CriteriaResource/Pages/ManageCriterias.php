<?php

namespace App\Filament\Resources\CriteriaResource\Pages;

use App\Filament\Resources\CriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCriterias extends ManageRecords
{
    protected static string $resource = CriteriaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
