<?php

namespace App\Filament\Resources\DeviceUserHistoryResource\Pages;

use App\Filament\Resources\DeviceUserHistoryResource;
use Filament\Resources\Pages\ListRecords;

class ListDeviceUserHistories extends ListRecords
{
    protected static string $resource = DeviceUserHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return []; // Nenhum botão de criar
    }

    protected function isTableSearchable(): bool
    {
        return true;
    }

    protected function isTablePaginationEnabled(): bool
    {
        return true;
    }
}
