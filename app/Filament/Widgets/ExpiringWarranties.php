<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Device;
use Filament\Tables\Table;
use Carbon\Carbon;
use Filament\Widgets\Widget;
use Filament\Widgets\TableWidget as BaseWidget;

class ExpiringWarranties extends BaseWidget
{

    protected static ?string $heading = 'Garantias a Vencer';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn () => Device::query()
                    ->whereDate('warranty_expiration', '>=', now())
                    ->whereDate('warranty_expiration', '<=', now()->addDays(60))
                    ->orderBy('warranty_expiration')
            )
            ->defaultPaginationPageOption(5) 
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->label('Código')
                    ->sortable(),

                Tables\Columns\TextColumn::make('device_type')
                    ->label('Tipo'),

                Tables\Columns\TextColumn::make('purchase_date')
                    ->label('Compra')
                    ->date('d/m/Y'),

                    Tables\Columns\TextColumn::make('warranty_expiration')
                    ->label('Vencimento')
                    ->date('d/m/Y')
                    ->color(fn ($record) => \Illuminate\Support\Carbon::parse($record->warranty_expiration)->lt(now()->addDays(10)) ? 'danger' : 'warning'),
                
            ]);
    }
}
