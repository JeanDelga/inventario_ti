<?php

namespace App\Filament\Pages;

use App\Models\Device;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Notifications\Notification;

class Dashboard extends BaseDashboard
{
    public function getViewData(): array
    {
        // Notificação se houver garantia vencendo nos próximos 30 dias
        $expiringSoonCount = Device::whereDate('warranty_expiration', '>=', now())
            ->whereDate('warranty_expiration', '<=', now()->addDays(60))
            ->count();

        if ($expiringSoonCount > 0) {
            Notification::make()
                ->title('Atenção: Garantias vencendo!')
                ->body("Existem {$expiringSoonCount} equipamento(s) com garantia vencendo nos próximos 60 dias.")
                ->warning()
                ->persistent()
                ->send();
        }

        return [];
    }

    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\CustomAccountWidget::class,
            \App\Filament\Widgets\DevicesByStatusWidget::class,
            \App\Filament\Widgets\ExpiringWarranties::class,
            \App\Filament\Widgets\LastDevices::class,
            \App\Filament\Widgets\DevicesStatusChart::class,
        ];
    }
}
