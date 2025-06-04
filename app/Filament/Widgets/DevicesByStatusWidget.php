<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use App\Constants\DeviceConstants;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DevicesByStatusWidget extends BaseWidget
{
    protected function getStats(): array
{
    $total = Device::count();

    return [
        Stat::make('Total de Equipamentos', $total)
            ->color('info'),

        Stat::make('Desktops', Device::where('device_type', 'Desktop')->count())
            ->color('success'),

        Stat::make('Notebooks', Device::where('device_type', 'Notebook')->count())
            ->color('primary'),

        Stat::make('Celulares', Device::where('device_type', 'Celular')->count())
            ->color('gray'),


    ];
}

}
