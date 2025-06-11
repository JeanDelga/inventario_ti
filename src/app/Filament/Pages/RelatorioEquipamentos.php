<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class RelatorioEquipamentos extends Page implements HasForms
{
    use InteractsWithForms;

    public $empresa = null;
    public $tipo = null;
    public $inicio = null;
    public $fim = null;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title = 'Relatório de Equipamentos';
    
    protected static ?string $navigationGroup = 'Consultas';

    protected static string $view = 'filament.pages.relatorio-equipamentos';

    protected function getFormSchema(): array
{
    return [
        Forms\Components\Grid::make(4)
            ->schema([
                Forms\Components\Select::make('empresa')
                    ->label('Empresa')
                    ->options(\App\Constants\DeviceConstants::COMPANYS)
                    ->searchable()
                    ->reactive(),

                Forms\Components\Select::make('tipo')
                    ->label('Tipo de Equipamento')
                    ->options(\App\Constants\DeviceConstants::DEVICE_TYPES)
                    ->searchable()
                    ->reactive(),

                Forms\Components\DatePicker::make('inicio')
                    ->label('Data Inicial')
                    ->native(false)
                    ->reactive(),

                Forms\Components\DatePicker::make('fim')
                    ->label('Data Final')
                    ->native(false)
                    ->reactive(),
            ]),
    ];
}

    public function getIframeUrl(): string
    {
        return route('relatorios.equipamentos', array_filter([
            'empresa' => $this->empresa,
            'tipo' => $this->tipo,
            'inicio' => $this->inicio,
            'fim' => $this->fim,
        ]));
    }
}
