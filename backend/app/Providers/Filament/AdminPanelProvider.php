<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Filament\Navigation\NavigationGroup;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->brandName('GlobalLine Admin')
            ->brandLogo(fn () => view('filament.components.logo'))
            ->brandLogoHeight('3rem')
            ->colors([
                'primary' => [
                    '50' => '#f0f4f8',
                    '100' => '#d1d9e6',
                    '200' => '#a3b4ce',
                    '300' => '#758fb6',
                    '400' => '#47699e',
                    '500' => '#002366', // Brand Navy
                    '600' => '#001e5c',
                    '700' => '#001952',
                    '800' => '#001347',
                    '900' => '#000e3d',
                ],
                'gray' => Color::Slate,
            ])
            ->font('Inter')
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make('Dashboard')->icon('heroicon-o-home'),
                NavigationGroup::make('Customers')->icon('heroicon-o-users'),
                NavigationGroup::make('Compliance')->icon('heroicon-o-shield-check'),
                NavigationGroup::make('Logistics')->icon('heroicon-o-truck'),
                NavigationGroup::make('Finance')->icon('heroicon-o-banknotes'),
                NavigationGroup::make('Support')->icon('heroicon-o-chat-bubble-left-right'),
                NavigationGroup::make('Config & Platform')->icon('heroicon-o-cog-6-tooth'),
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\OpsQueueWidget::class,
                \App\Filament\Widgets\AlertsWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ])
            ->renderHook(
                'panels::head.end',
                fn (): string => '<link rel="stylesheet" href="' . asset('css/filament/admin/soft-ui-theme.css') . '">'
            );
    }
}
