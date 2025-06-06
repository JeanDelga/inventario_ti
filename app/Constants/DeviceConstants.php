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
        'Windows XP' => 'Windows XP HOME',
        'Windows 7' => 'Windows 7 HOME',
        'Windows 8' => 'Windows 8 HOME',
        'Windows 10' => 'Windows 10 HOME',
        'Windows 11' => 'Windows 11 HOME',
        'Windows 7' => 'Windows 7 PRO',
        'Windows 8' => 'Windows 8 PRO',
        'Windows 10' => 'Windows 10 PRO',
        'Windows 11' => 'Windows 11 PRO',
        'Windows Server 2008' => 'Windows Server 2008',
        'Windows Server 2012' => 'Windows Server 2012',
        'Windows Server 2016' => 'Windows Server 2016',
        'Windows Server 2019' => 'Windows Server 2019',
        'Windows Server 2022' => 'Windows Server 2022',
        'Ubuntu' => 'Ubuntu',
        'Debian' => 'Debian',
        'Fedora' => 'Fedora',
        'macOS' => 'macOS',
        'Android' => 'Android',
        'iOS' => 'iOS',
        'Outro' => 'Outro',
    ];

    public const COMPANYS = [
        'BRVAL Electrical' => 'BRVAL Electrical',
        'BRVAL Transformadores' => 'BRVAL Transformadores',
        'BRVAL Service' => 'BRVAL Service',
        'BRVAL SRB' => 'BRVAL SRB',
        'BRVAL Cooling' => 'BRVAL Cooling',
        'BRVAL Automação' => 'BRVAL Automação',
        'Efficient' => 'Efficient',
        'M4R' => 'M4R',
        'Pousada Arara' => 'Pousada Arara',

    ];

    public const COMPANY_CODES = [
        'BRVAL Electrical' => 'BR',
        'BRVAL Transformadores' => 'BT',
        'BRVAL Service' => 'BS',
        'BRVAL SRB' => 'SR',
        'BRVAL Cooling' => 'BC',
        'BRVAL Automação' => 'BA',
        'Efficient' => 'EF',
        'M4R' => 'M4',
        'Pousada Arara' => 'AR',
    ];
}
