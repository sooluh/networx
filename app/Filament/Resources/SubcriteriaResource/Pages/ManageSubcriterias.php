<?php

namespace App\Filament\Resources\SubcriteriaResource\Pages;

use App\Filament\Resources\SubcriteriaResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageSubcriterias extends ManageRecords
{
    protected static string $resource = SubcriteriaResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth(MaxWidth::Large),
        ];
    }
}
