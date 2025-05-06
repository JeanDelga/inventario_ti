<?php

namespace App\Constants;

class DeviceConstants
{
    public const DEVICE_TYPES = [
        'Servidor' => 'Servidor',
        'Notebook' => 'Notebook',
        'Desktop' => 'Desktop',
        'Celular' => 'Celular',
        'Tablet' => 'Tablet',
        'Impressora' => 'Impressora',
        'Scanner' => 'Scanner',
        'Outro' => 'Outro',
    ];

    public const STATUS = [
        'Em uso' => 'Em uso',
        'Estoque' => 'Estoque',
        'Manutenção' => 'Manutenção',
        'Descartado' => 'Descartado',
    ];

    public const STATUS_COLORS = [
        'Em uso' => 'success',
        'Estoque' => ' #0000ff',
        'Manutenção' => 'warning',
        'Descartado' => 'danger',
    ];

    public const OPERATING_SYSTEMS = [
        'Windows XP' => 'Windows XP',
        'Windows 7' => 'Windows 7',
        'Windows 8' => 'Windows 8',
        'Windows 10' => 'Windows 10',
        'Windows 11' => 'Windows 11',
        'Linux' => 'Linux',
        'macOS' => 'macOS',
        'Android' => 'Android',
        'iOS' => 'iOS',
        'Outro' => 'Outro',
    ];
}
