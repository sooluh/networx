<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Login;
use App\Filament\Pages\Profile;
use Awcodes\FilamentGravatar\GravatarPlugin;
use Awcodes\FilamentGravatar\GravatarProvider;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Assets;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class StudioPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('studio')
            ->path('studio')
            ->login(Login::class)
            ->colors(['primary' => Color::Amber])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->authMiddleware([Authenticate::class])
            ->defaultAvatarProvider(GravatarProvider::class)
            ->plugins([GravatarPlugin::make()])
            ->userMenuItems([
                'profile' => MenuItem::make()
                    ->label('Profil')
                    ->icon('heroicon-o-user-circle')
                    ->url(static fn (): string => route(Profile::getRouteName('studio'))),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->assets([
                Assets\Css::make('custom', asset('css/networx/app.css')),
                Assets\Js::make('custom', asset('js/networx/app.js')),
            ])
            ->maxContentWidth('full')
            ->sidebarCollapsibleOnDesktop()
            ->breadcrumbs(false)
            ->collapsibleNavigationGroups(false)
            ->databaseTransactions()
            ->spa();
    }
}
