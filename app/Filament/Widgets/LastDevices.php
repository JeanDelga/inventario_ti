<?php

namespace App\Filament\Widgets;

use App\Models\Device;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastDevices extends BaseWidget
{
    protected static ?string $heading = 'Últimos Cadastrados';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn () => Device::query()
                    ->latest()
            )
            ->defaultPaginationPageOption(5) 
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código'),

                Tables\Columns\TextColumn::make('device_type')
                    ->label('Tipo')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => \App\Constants\DeviceConstants::STATUS_COLORS[$state] ?? 'gray'),
            ]);
    }

}
