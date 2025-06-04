<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Pages\AuthLogin;
use Filament\Support\Colors\Color;
use App\Filament\Widgets\LastDevices;
use Filament\Navigation\NavigationGroup;
use Filament\Http\Middleware\Authenticate;
use Rmsramos\Activitylog\ActivitylogPlugin;
use App\Filament\Widgets\DevicesStatusChart;
use App\Filament\Widgets\ExpiringWarranties;
use App\Filament\Widgets\CustomAccountWidget;
use App\Filament\Widgets\DevicesByStatusWidget;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->sidebarCollapsibleOnDesktop(true)
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\AuthLogin::class)
            ->brandName('Inventário TI')
            ->colors([
                'primary' => '#57A695'
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])
            ->widgets([
                \App\Filament\Widgets\CustomAccountWidget::class,
                \App\Filament\Widgets\DevicesStatusChart::class,
                \App\Filament\Widgets\DevicesByStatusWidget::class,
                \App\Filament\Widgets\LastDevices::class,
                \App\Filament\Widgets\ExpiringWarranties::class,
            ])
            
            ->navigationGroups([
            NavigationGroup::make()
                ->label('Controle'),
            NavigationGroup::make()
                ->label('Cadastros'),
            NavigationGroup::make()
                ->label('Consultas'),
            ])
            
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            
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
            ->plugins([
                ActivitylogPlugin::make()
                    ->label('Logs')
                    ->navigationGroup('Consultas'),

            ]);
    }
}
