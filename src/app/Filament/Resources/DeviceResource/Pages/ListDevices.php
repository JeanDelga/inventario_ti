<?php

namespace App\Filament\Resources\DeviceResource\Pages;

use App\Filament\Resources\DeviceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDevices extends ListRecords
{
    protected static string $resource = DeviceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                    ->label('Novo Equipamento')
                    ->modalHeading('Cadastrar Equipamento')
                    ->modalWidth('5xl')
                    ->createAnother(),
        ];
    }
}