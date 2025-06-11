<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Device;

class DevicesStatusChart extends ChartWidget
{   
    
    protected static ?string $heading = 'Equipamentos por Status';
    protected static string $color = 'primary'; // cor do gráfico

    
    protected function getData(): array
    {
        $statuses = [
            'Em uso',
            'Estoque',
            'Manutenção',
            'Descartado',
        ];

        $data = [];
        foreach ($statuses as $status) {
            $data[] = Device::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Equipamentos',
                    'data' => $data,
                    'backgroundColor' => [
                        '#34D399', // Em uso
                        '#60A5FA', // Estoque
                        '#FBBF24', // Manutenção
                        '#F87171', // Descartado
                    ],
                ],
            ],
            'labels' => $statuses,
        ];
    }

    protected function getType(): string
    {
        return 'pie'; // ou 'bar', 'line', etc.
    }
}
