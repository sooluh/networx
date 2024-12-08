<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Profile extends Page
{
    protected static string $view = 'filament.pages.profile';

    protected static bool $shouldRegisterNavigation = false;

    public function getTitle(): string|Htmlable
    {
        return 'Edit Profil';
    }

    protected function getViewData(): array
    {
        return [
            'user' => auth('web')->user(),
        ];
    }
}
