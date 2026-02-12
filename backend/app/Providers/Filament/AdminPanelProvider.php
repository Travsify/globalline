<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\CustomLogin::class)
            ->brandName('GlobalLine')
            ->brandLogo(fn () => view('filament.components.logo'))
            ->darkMode(false)
            ->colors([
                'primary' => [
                    50 => '#f0f4ff',
                    100 => '#dbe3ff',
                    200 => '#b3c4ff',
                    300 => '#809fff',
                    400 => '#4d7aff',
                    500 => '#002366',
                    600 => '#001e5c',
                    700 => '#001952',
                    800 => '#001347',
                    900 => '#000e3d',
                    950 => '#000927',
                ],
                'gray' => Color::Slate,
                'danger' => Color::Rose,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => Color::Amber,
            ])
            ->font('Inter')
            ->sidebarCollapsibleOnDesktop()
            ->navigationGroups([
                NavigationGroup::make('Dashboard'),
                NavigationGroup::make('Customers'),
                NavigationGroup::make('Marketplace'),
                NavigationGroup::make('Compliance'),
                NavigationGroup::make('Logistics'),
                NavigationGroup::make('Finance'),
                NavigationGroup::make('Support'),
                NavigationGroup::make('Communications'),
                NavigationGroup::make('System'),
                NavigationGroup::make('Config & Platform'),
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
