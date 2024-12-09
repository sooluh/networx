<?php

namespace App\Filament\Resources\AlternativeResource\Pages;

use App\Filament\Resources\AlternativeResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\MaxWidth;

class ManageAlternatives extends ManageRecords
{
    protected static string $resource = AlternativeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()->modalWidth(MaxWidth::Large),
        ];
    }
}
